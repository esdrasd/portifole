show databases;
use banco_test;
show tables;

select * from y
left join x
on y.id_x = x.id;