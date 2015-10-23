/* 	database 1.0
last_updated- 29/10 12:40; created- 27/10 02:20; author- travis_bickle
usage- 	backup old copy of `swap` (saving it date appended):
			mysqldump -u root -p swap > swap_DATE.sql
			mysql -u root -p -e drop database swap
		Add this copy as current version:
			mysql -u root -p -e "create database swap"
			mysql -u root -p swap < THIS.sql
		However it is time and space consuming, once the database floods, will think of better method soon #TODO 27/10 Anyone#
comment- talk to me about ER diagram, and before making any changes Do talk to me.
*/

-- create database if not exist `swap`;
use `swap`;
SET foreign_key_checks = 1;



-- user
create table `user_auth` (`uid` int primary key auto_increment, `user_name` char(20) unique not null, `pwd` char(20) not null ) engine=innodb; /*Change password to hashed_pwd */
create table `user_info` (`uid` int unique not null, `name` char(20) not null, `dob` date, `email` char(30) not null unique, `phone_number` int, `address` varchar(30), `zip` int, `bio` varchar(50), `notif_check_date` timestamp not null, foreign key auth_to_info(uid) references user_auth(uid) on update cascade on delete cascade )engine=innodb; /*Indexing of name; necessary_use_php email, zip; static_use_php uid; check limits/size of name, address,.. ; auto-pick notif_check_date; add link_to_photo*/



-- address
/* Instead of this zip,city,state logic you can directly ask user of his state, city */
create table loc1 (`zip` int not null unique, `cityid` int not null) engine=innodb;
create table loc2 (`cityid` int not null unique, `name` char(20) not null, `stateid` int not null) engine=innodb;
create table loc3 (`stateid` int not null unique, `name` char(20) not null) engine=innodb;
alter table user_info add foreign key zip_check(zip) references loc1(zip) on update cascade on delete restrict;
alter table loc1 add foreign key city_check(cityid) references loc2(cityid) on update cascade on delete restrict;
alter table loc2 add foreign key state_check(stateid) references loc3(stateid) on update cascade on delete restrict;



-- product
create table `product` (`pid` int primary key auto_increment, `uid` int not null, `p_name` char(20) not null, `p_desc` varchar(50) not null , `date_created` date not null, foreign key user_to_product(uid) references user_auth(uid) on update cascade on delete cascade ) engine=innodb; /*Indexing of p_name; keyword search from p_name and p_desc; p_desc ensure minimum ~15 char; date_created self add use php; swapped usage 0/1/2 for public/deal signed/shipped, 0 intialised; necessary_use_php p_name, p_desc; static_use_php pid, date_created */



-- relationships
create table `favourite` (`uid` int not null, `pid` int not null, create_date timestamp not null, foreign key user_to_favourite(uid) references user_auth(uid) on update cascade on delete cascade, foreign key product_to_favourite(pid) references product(pid) on update cascade on delete cascade,  CONSTRAINT pid_uid PRIMARY KEY (uid,pid) ) engine=innodb; /*static_use_php uid,pid; only insert and delete has to be used in this table and no update command; Ensure that no user can favourite his own product*/ /*favourites are wishlist and we ant thier notification*/

create table `request` (`pid1` int not null, `pid2` int not null, `state` int not null, `update_date` timestamp not null, foreign key product_to_request(pid2) references product(pid) on update cascade on delete cascade, foreign key product_get_request(pid1) references product(pid) on update cascade on delete cascade) engine=innodb;  /* USAGE- pid2's parent is requesting for pid1 product. For two pid's before INSERTing check if (pidx,pidy) or (pidy,pidx) pairs exist- if they exist then dont add and do something; Ensure that pid1!=pid2; static_use_php pid1,pid2; only insert and delete has to be used in this table and no update command; State is 0 initialised and can take -1/0/1: for rejected, wait list, accepted; if state changes from 0 to 1, make state of other requests for that pid1 as -1; if state changes from 0 to -1, remove it from notifications(no big deal); can state be changed from 1 to -1?? */

create table `buddy` (`uid1` int not null, `uid2` int not null, foreign key auth_to_buddy1(uid1) references user_auth(uid) on update cascade on delete cascade, foreign key auth_to_buddy2(uid2) references user_auth(uid) on update cascade on delete cascade ) engine=innodb; /*USAGE uid1<uid2(strictly less) ; static_use_php uid1, uid2; only insert and delete has to be used in this table and no update command; */



-- Insertion of sample data
insert into loc3 (stateid, name) values(1,'Himachal Pradesh'),(2,'Haryana');
insert into loc2 (cityid,name,stateid) values(1,'Mandi',1),(2,'Ambala Cantt',2),(3,'Ambala City',2);
insert into loc1 (zip,cityid) values(175001,1),(133001,2),(133002,3);
insert into user_auth (uid,user_name,pwd) values(1,'a_jindal','jindal'),(2,'a_bedi','bedi'),(3,'s_chandel','chendel'); /* #TODO 27/10 @sksq In pracitce one doesnot have to provie uid, and also one has to retrive corresponding uid for user_info table*/
insert into user_info (uid,name,dob,email,zip,notif_check_date) values(1,'Ankush Jindal',19950101,'a@j.com',133001,now()),(2,'Ashish Bedi',19960320,'a@b.com',175001,now()),(3,'Shubham Chandel',19951212,'s@c.com',133002,now());
insert into product (uid,p_name,p_desc,date_created,swapped) values(1,'laptop','Mera i7 lelo mujhe chromebook leni hai',20141027,0),(2,'phone','Mera nexus lelo isme lolipop nahi hai',20141026,0),(2,'laptop','Mera laptop lelo muje trivedi ka lena hai',20141025,0),(3,'pen','Lexus ka hai from ebay',19950101,0),(3,'rubber','Jyothir ki hai',20141030,0); /*In practice date_created and swapped has to be auto fed*/

--This is ashish favouriting ankush's laptop and shubham's pen
insert into favourite(uid,pid,create_date) value(2,1,now());
insert into favourite(uid,pid,create_date) value(2,4,now()); /*uid of ashish/shubham will be taken as they are logged in, pid of product will be taken from search query corresponding to this product*/

--This is for product's profile page (Show swapped, uid) (Example for shubham's pen)
	--People favouriting it:
	select user_info.name from user_info,favourite where user_info.uid=favourite.uid AND favourite.pid=4;
	--All incoming requests(can filter for rejected/current):
	select product.p_name, product.p_desc, user_info.name from request,product,user_info where request.pid1=4 AND request.pid2=product.pid AND user_info.uid=product.uid;
	--Outgoing requests(can filter for rejected/current):
	select product.p_name, product.p_desc, user_info.name from request,product,user_info where request.pid2=4 AND request.pid1=product.pid AND user_info.uid=product.uid;
	/*Display number of request up and down (UI feature to get whats treading)
	#TODO @travis_bickle 29/10 */

--This is user's profile page (Show products) (Example for shubham)
	--Buddies:
	select user_info.name from buddy,user_info where (buddy.uid1=3 AND buddy.uid2=user_info.uid) OR (buddy.uid2=3 AND buddy.uid1=user_info.uid); /* #TODO 28/10 Use the fact that uid1<uid2 and do some performance hack @Anyone*/
	--All incoming requests(can filter for current/rejected/accepted)
	select * from request where request.pid1 in (select product.pid from product where product.uid=3);
	--All outgoing requests(can filter for current/rejected/accepted)
	select * from request where request.pid2 in (select product.pid from product where product.uid=3);
	--See notifications for more info

--This is shubham querying for laptop in his state 'Haryana' (which he knows as well as his logged in browser knows)
select product.p_name, product.p_desc, user_info.name from product,user_info,loc1,loc2,loc3 where loc3.name='Haryana' AND loc3.stateid=loc2.stateid AND loc2.cityid=loc1.cityid AND loc1.zip=user_info.zip AND product.p_name='laptop' AND product.uid=user_info.uid; 

--This is shubham searching for all products from his buddies only
select product.p_name, product.p_desc, user_info.name from product,user_info,buddy where (buddy.uid1=3 AND buddy.uid2=product.uid AND user_info.uid=buddy.uid2) OR (buddy.uid2=3 AND buddy.uid1=product.uid AND user_info.uid=buddy.uid1);

--Thish is shubham searching for laptop and sorting by number of favourites
select distinct product.p_name,product.p_desc,user_info.name from product, user_info,favourite where product.p_name='laptop' AND user_info.uid=product.uid order by (select count(favourite.uid) from favourite where favourite.pid=product.pid) desc; /* #TODO Get some method of removing distinct and getting non-repeating queries itself: Change the query desirably (Maybe joins are to be used; UPDATE due to same uid,pid in favourite some repetition is occuring, solve it, after reading it, IMPORTANT) @Anyone */

--This is Ashish, and Ankush then requesting for shubham's pen after doing some similar query. Ashish is requesting for ankush's laptop also (only in exchange with his laptop), and ankush for shubham's rubber
insert into request (pid2,pid1,state,update_date) values(2,4,0,now()),(3,4,0,now());
insert into request (pid2,pid1,state,update_date) values(1,4,0,now());
insert into request (pid2,pid1,state,update_date) values(3,1,0,now());
insert into request (pid2,pid1,state,update_date) values(1,5,0,now());
	/*Add these requests correspondigly to favourite also. or count favourites+=requests*/

--Trending search /*Two parameters: Requests(incoming and outgoing)(and its state) and favourites and their time; for now i am using only incoming requests (time normalised) Sort by something like this:  select sum(10000/(now()-update_date)) from request where pid1=4 group by pid1;
#TODO @travis_bickle 29/10 do this; do something for user searching also(low priroity*/

--Notifications shubham will be shown
	--Outgoing all
	select * from request where pid2 in (select product.pid from product where product.uid=3);
	--incoming all
	select * from request where pid1 in (select product.pid from product where product.uid=3) AND state=0; /*User don't want to know about requests he himself declined*/
	--incoming super-all
	select * from request where pid1 in (select product.pid from product where product.uid=3); /*All previous requests too*/
	--outgoing unseen(updated)
	select request.state,request.pid1,request.pid2,user_info.name,request.update_date,user_info.notif_check_date from request,user_info,product where product.uid=user_info.uid AND request.pid2=product.pid AND notif_check_date<update_date AND user_info.uid=3;
	--incoming unseen(new)
	select request.state,request.pid2,request.pid1,request.update_date,user_info.notif_check_date from request,user_info,product where product.uid=user_info.uid AND request.pid1=product.pid AND notif_check_date<update_date AND user_info.uid=3;
		--incoming unseen from your swap buddy
		select request.state,request.pid2,request.pid1,request.update_date,user_info.notif_check_date from request,user_info,product where product.uid=user_info.uid AND request.pid1=product.pid AND notif_check_date<update_date AND user_info.uid=3 AND request.pid2 in (select product.pid from product,user_info,buddy where (buddy.uid1=3 AND buddy.uid2=product.uid AND user_info.uid=buddy.uid2) OR (buddy.uid2=3 AND buddy.uid1=product.uid AND user_info.uid=buddy.uid1));
	--favourite incoming
	select favourite.uid,favourite.pid from favourite,user_info where favourite.pid in (select product.pid from product where product.uid=3) AND user_info.notif_check_date<favourite.create_date;
	--favourite outgoing
	select request.state,request.pid2,request.pid1,request.update_date,user_info.notif_check_date from request,user_info,product where product.pid in (select favourite.pid from favourite where favourite.uid=3) AND notif_check_date<update_date AND user_info.uid=3 AND (request.pid1=product.pid OR request.pid2=product.pid);

--After this notification problem is handled: #TODO 28/10 how to do after the two user aggree for the swap, and even how to provide this interface. Also in this case Ashish's laptop has given request to ankush's laptop and shubham's pen. What will happen in case of conflict? Or multiple outgoing requests possible? @anyone */
