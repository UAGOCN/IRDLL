CREATE TABLE IF NOT EXISTS info_user (
  user_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  user_name varchar(50) NOT NULL,
  user_pwd char(32) NOT NULL,
  user_md5 varchar(32) NOT NULL,
  user_lock varchar(32) NOT NULL,
  user_email varchar(50) NOT NULL,
  user_ip varchar(40) NOT NULL,
  user_logintime int(11) NOT NULL,
  PRIMARY KEY (user_id),
  KEY user_md5 (user_md5)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO info_user (user_id, user_name, user_pwd, user_md5, user_lock, user_email, user_ip, user_logintime) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3', '10000@qq.com', '127.0.0.1', 1311954804);