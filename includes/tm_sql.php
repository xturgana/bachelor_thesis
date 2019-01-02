<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10.11.2018
 * Time: 21:26
 */

function tm_create_database()
{
    global $wpdb;

    $tm_quizzes_table = $wpdb->prefix . "tm_quizzes";
    $tm_questions_table = $wpdb->prefix . "tm_questions";
    $tm_answers_table = $wpdb->prefix . "tm_answers";
    $tm_results_table = $wpdb->prefix . "tm_results";
    $tm_result_final_table = $wpdb->prefix . "tm_result_final";

    $tm_quizzes_sql = "CREATE TABLE IF NOT EXISTS `" . $tm_quizzes_table . "` (
	  `id` int(10) NOT NULL AUTO_INCREMENT,
	  `name` varchar(100) NOT NULL,
	  `description` text NOT NULL,
	  `random` tinyint(4) NOT NULL DEFAULT '0',
	  `skip` tinyint(4) NOT NULL DEFAULT '0',
	  `right_color` varchar(7) NOT NULL DEFAULT '#00FF00',
	  `wrong_color` varchar(7) NOT NULL DEFAULT '#FF0000',
	  `numbering_type` varchar(15) NOT NULL,
	  `show_type` varchar(15) NOT NULL,
	  `typ_test` varchar(10) NOT NULL,
	  `times_taken` int(7) NOT NULL,
	  `avg_percent` float NOT NULL DEFAULT '0',
	  PRIMARY KEY (`id`)
	) DEFAULT CHARSET=utf8;";

    ;

    $tm_questions_sql = "CREATE TABLE IF NOT EXISTS `" . $tm_questions_table . "` (
	  `id` int(14) NOT NULL AUTO_INCREMENT,
	  `quiz_id` int(10) NOT NULL,
	  `order` int(4) NOT NULL,
	  `text` text NOT NULL,
	  `right_message` text NOT NULL,
	  `wrong_message` text NOT NULL,
	  `answer_random` tinyint(4) NOT NULL DEFAULT '0',
	  `answer_type` varchar(10) NOT NULL,
	  `points` int(20) NOT NULL,
	  PRIMARY KEY (`id`)
	) DEFAULT CHARSET=utf8;";

    $tm_answers_sql = "CREATE TABLE IF NOT EXISTS `" . $tm_answers_table . "` (
	  `id` int(17) NOT NULL AUTO_INCREMENT,
	  `text` varchar(200) NOT NULL,
	  `question_id` int(14) NOT NULL,
	  `order` int(4) NOT NULL,
	  `right_wrong` tinyint(4) NOT NULL,
	  PRIMARY KEY (`id`)
	) DEFAULT CHARSET=utf8;";

    $tm_results_sql = "CREATE TABLE IF NOT EXISTS `" . $tm_results_table . "` (
	    `id` int(17) NOT NULL AUTO_INCREMENT,
	  `user_id` int(10) NOT NULL,
	  `question_id` int(14) NOT NULL,
	  `quiz_id` int(10) NOT NULL,
	  `user_answer_numbers` varchar(15) NOT NULL,
	  `right_answer_numbers` varchar(15) NOT NULL,
	  `correctness_value` float NOT NULL,
	  `points` int(15) NOT NULL,
	  `completed` tinyint(4) NOT NULL,
	  `date` int(10) NOT NULL,
	  PRIMARY KEY (`id`)
	) DEFAULT CHARSET=utf8;";

    $tm_result_final_table = "CREATE TABLE IF NOT EXISTS `" . $tm_result_final_table . "` (
	  `id` int(14) NOT NULL AUTO_INCREMENT,
	  `quiz_id` int(10) NOT NULL,
	  `user_id` int(10) NOT NULL,
	  `points` int(15) NOT NULL,
	  `date` text NOT NULL,
	  PRIMARY KEY (`id`)
	) DEFAULT CHARSET=utf8;";

    $wpdb->query($tm_quizzes_sql);
    $wpdb->query($tm_questions_sql);
    $wpdb->query($tm_answers_sql);
    $wpdb->query($tm_results_sql);
    $wpdb->query($tm_result_final_table);
}

function tm_deactivation()
{
    flush_rewrite_rules();
}

function tm_delete_database()
{
    global $wpdb;
    $table_name1 = $wpdb->prefix . "tm_quizzes";
    $table_name2 = $wpdb->prefix . "tm_questions";
    $table_name3 = $wpdb->prefix . "tm_results";
    $table_name4 = $wpdb->prefix . "tm_answers";
    $table_name5 = $wpdb->prefix . "tm_result_final";

    $wpdb->query("DROP TABLE IF EXISTS $table_name1");
    $wpdb->query("DROP TABLE IF EXISTS $table_name2");
    $wpdb->query("DROP TABLE IF EXISTS $table_name3");
    $wpdb->query("DROP TABLE IF EXISTS $table_name4");
    $wpdb->query("DROP TABLE IF EXISTS $table_name5");
}

function tm_insert_quiz_data()
{
    global $wpdb;
    if (!empty($_POST['title'])) {
        $tm_title = $_POST['title'];
        $tm_description = $_POST['description'];
        $tm_time = $_POST['time'];
        $tm_rightcolor = "#" . $_POST['rightcolor'];
        $tm_wrongcolor = "#" . $_POST['wrongcolor'];
        $tm_numbtype = $_POST['numbtype'];
        $tm_typetest = $_POST['typetest'];
        $tm_showtype = $_POST['showtype'];
        $tm_random = isset($_POST['random']) ? 1 : 0;
        $tm_skip = isset($_POST['skip']) ? 1 : 0;


        $wpdb->insert($wpdb->prefix . 'tm_quizzes',
            array(
                'name' => $tm_title,
                'description' => $tm_description,
                'right_color' => $tm_rightcolor,
                'wrong_color' => $tm_wrongcolor,
                'numbering_type' => $tm_numbtype,
                'show_type' => $tm_showtype,
                'random' => $tm_random,
                'skip' => $tm_skip,
                'typ_test' => $tm_typetest
            ));
    }
    wp_redirect($_SERVER['HTTP_REFERER']);
    exit();
}

function tm_update_quiz_data()
{
    global $wpdb;
    if (!empty($_POST['title'])) {
        $tm_id = $_POST['id'];
        $tm_title = $_POST['title'];
        $tm_description = $_POST['description'];
        $tm_rightcolor = "#" . $_POST['rightcolor'];
        $tm_wrongcolor = "#" . $_POST['wrongcolor'];
        $tm_numbtype = $_POST['numbtype'];
        $tm_typtest = $_POST['typetest'];
        $tm_showtype = $_POST['showtype'];
        $tm_skip = isset($_POST['skip']) ? 1 : 0;

        $wpdb->update($wpdb->prefix . 'tm_quizzes',
            array(
                'name' => $tm_title,
                'description' => $tm_description,
                'right_color' => $tm_rightcolor,
                'wrong_color' => $tm_wrongcolor,
                'numbering_type' => $tm_numbtype,
                'show_type' => $tm_showtype,
                'typ_test' => $tm_typtest,
                'skip' => $tm_skip
            ),
            array('id' => $tm_id));
    }
    wp_redirect($_SERVER['HTTP_REFERER']);
    exit();
}

function tm_insert_question_data()
{
    global $wpdb;
    $tm_intqid = (int)$_POST['quizid'];
    $tm_last_order = $wpdb->get_row($wpdb->prepare("select `order` from " . $wpdb->prefix . "tm_questions 
	where quiz_id = %d order by `order` desc limit 1", $tm_intqid));

    if (!empty($_POST['text'])) {
        $tm_order = ($tm_last_order == null) ? 1 : $tm_last_order->order + 1;
        $tm_quizid = $_POST['quizid'];
        $tm_text = $_POST['text'];
        $tm_rightmsg = $_POST['rightmsg'];
        $tm_wrongmsg = $_POST['wrongmsg'];
        $tm_ansrand = isset($_POST['ansrand']) ? 1 : 0;
        $tm_anstype = $_POST['anstype'];
        $tm_points = $_POST['points'];

        $wpdb->insert($wpdb->prefix . 'tm_questions',
            array(
                'quiz_id' => $tm_quizid,
                'order' => $tm_order,
                'text' => $tm_text,
                'right_message' => $tm_rightmsg,
                'wrong_message' => $tm_wrongmsg,
                'right_message' => $tm_rightmsg,
                'answer_random' => $tm_ansrand,
                'answer_type' => $tm_anstype,
                'points' => $tm_points
            ));
        $tm_questionid = $wpdb->insert_id;
        foreach ($_POST as $key => $val) {
            if (strpos($key, 'answer') !== false) {
                if ($key == $_POST['rw'] || (is_array($_POST['rw']) && in_array($key, $_POST['rw']))) {
                    $rw = 1;
                } else {
                    $rw = 0;
                }
                $wpdb->insert($wpdb->prefix . 'tm_answers',
                    array(
                        'text' => $val,
                        'question_id' => $tm_questionid,
                        'order' => substr($key, -1),
                        'right_wrong' => $rw
                    ));
            }
        }
    }
    wp_redirect($_SERVER['HTTP_REFERER']);
    exit();
}

function tm_update_question_data()
{
    global $wpdb;

    if (!empty($_POST['text'])) {
        $tm_questionid = (int)$_POST['questionid'];
        $tm_order = $tm_order = $_POST['order'];
        $tm_quizid = $_POST['quizid'];
        $tm_text = stripslashes($_POST['text']);
        $tm_rightmsg = stripslashes($_POST['rightmsg']);
        $tm_wrongmsg = stripslashes($_POST['wrongmsg']);
        $tm_ansrand = isset($_POST['ansrand']) ? 1 : 0;
        $tm_anstype = $_POST['anstype'];
        $tm_points = $_POST['points'];

        $wpdb->update($wpdb->prefix . 'tm_questions',
            array(
                'order' => $tm_order,
                'text' => $tm_text,
                'right_message' => $tm_rightmsg,
                'wrong_message' => $tm_wrongmsg,
                'right_message' => $tm_rightmsg,
                'answer_random' => $tm_ansrand,
                'answer_type' => $tm_anstype,
                'points' => $tm_points
            ),
            array('id' => $tm_questionid));

        $wpdb->query($wpdb->prepare("delete from " . $wpdb->prefix . "tm_answers where question_id = %d", $tm_questionid));
        foreach ($_POST as $key => $val) {
            if (strpos($key, 'answer') !== false) {
                if ($key == $_POST['rw'] || (is_array($_POST['rw']) && in_array($key, $_POST['rw']))) {
                    $rw = 1;
                } else {
                    $rw = 0;
                }
                $wpdb->insert($wpdb->prefix . 'tm_answers',
                    array(
                        'text' => $val,
                        'question_id' => $tm_questionid,
                        'order' => substr($key, -1),
                        'right_wrong' => $rw
                    ));
            }
        }
    }
    wp_redirect($_SERVER['HTTP_REFERER']);
    exit();
}

function tm_delete_quiz()
{
    global $wpdb;

    $tm_del_ids = "";
    foreach ($_POST as $key => $val) {
        if (strpos($key, 'del') !== false) {
            $tm_del_ids .= $val . ",";
        }
    }
    $tm_del_ids = substr($tm_del_ids, 0, -1);

    $wpdb->query($wpdb->prepare("delete from " . $wpdb->prefix . "tm_quizzes where id in (%s)", $tm_del_ids));

    $tm_del_questions = $wpdb->get_results($wpdb->prepare("select id from " . $wpdb->prefix . "tm_questions where quiz_id in (%s)", $tm_del_ids));


    $tm_del_question_ids = "";
    foreach ($tm_del_questions as $qldq) {
        $tm_del_question_ids .= $qldq->id . ",";
    }
    $tm_del_question_ids = substr($tm_del_question_ids, 0, -1);


    $wpdb->query($wpdb->prepare("delete from " . $wpdb->prefix . "tm_answers where question_id in (%s)", $tm_del_question_ids));
    $wpdb->query($wpdb->prepare("delete from " . $wpdb->prefix . "tm_questions where quiz_id in (%s)", $tm_del_ids));
    $wpdb->query($wpdb->prepare("delete from " . $wpdb->prefix . "tm_results where quiz_id in (%s)", $tm_del_ids));
    $wpdb->query($wpdb->prepare("delete from " . $wpdb->prefix . "tm_result_final where quiz_id in (%s)", $tm_del_ids));

    wp_redirect($_SERVER['HTTP_REFERER']);
    exit();
}

function tm_delete_question()
{
    global $wpdb;


    foreach ($_POST as $key => $val) {
        if (strpos($key, 'del') !== false) {
            $tm_del_ids[] = (int)$val;
        }
    }

    $tm_quizid = $_POST['quizid'];

    foreach ($tm_del_ids as $qld) {
        $qlord = $wpdb->get_var($wpdb->prepare("select `order` from " . $wpdb->prefix . "tm_questions where id = %d", $qld));

        $wpdb->query($wpdb->prepare("delete from " . $wpdb->prefix . "tm_questions where id = %d", $qld));
        $wpdb->query($wpdb->prepare("update " . $wpdb->prefix . "tm_questions set `order` = `order` - 1 
		where `order` > %s and quiz_id = $tm_quizid", $qlord));
        $wpdb->query($wpdb->prepare("delete from " . $wpdb->prefix . "tm_answers where question_id = %d", $qld));
        $wpdb->query($wpdb->prepare("delete from " . $wpdb->prefix . "tm_results where question_id = %d", $qld));
    }

    wp_redirect($_SERVER['HTTP_REFERER']);
    exit();
}

function tm_delete_result()
{
    global $wpdb;

    foreach ($_POST as $key => $val) {
        if (strpos($key, 'del') !== false) {
            $tm_del_ids[] = (int)$val;
        }
    }

    $tm_quizid = $_POST['quizid'];

    foreach ($tm_del_ids as $qld) {
        $wpdb->query($wpdb->prepare("delete from " . $wpdb->prefix . "tm_result_final where id = %d", $qld));
    }

    wp_redirect($_SERVER['HTTP_REFERER']);
    exit();
}

function tm_reset_statics()
{
    global $wpdb;

    $wpdb->update($wpdb->prefix . 'tm_quizzes', array(
        'times_taken' => 0,
        'avg_percent' => 0
    ),
        array('typ_test' => 'others'));

    $wpdb->update($wpdb->prefix . 'tm_quizzes', array(
        'times_taken' => 0,
        'avg_percent' => 0
    ),
        array('typ_test' => 'students'));

    $wpdb->update($wpdb->prefix . 'tm_quizzes', array(
        'times_taken' => 0,
        'avg_percent' => 0
    ),
        array('typ_test' => 'teachers'));

    $wpdb->update($wpdb->prefix . 'tm_quizzes', array(
        'times_taken' => 0,
        'avg_percent' => 0
    ),
        array('typ_test' => 'firms'));


    wp_redirect($_SERVER['HTTP_REFERER']);
    exit();


}

add_action('admin_action_tm_result_delete', 'tm_delete_result');

add_action('admin_action_tm_update', 'tm_update_quiz_data');

add_action('admin_action_tm_insert', 'tm_insert_quiz_data');

add_action('admin_action_tm_question_insert', 'tm_insert_question_data');

add_action('admin_action_tm_question_update', 'tm_update_question_data');

add_action('admin_action_tm_quiz_delete', 'tm_delete_quiz');

add_action('admin_action_tm_question_delete', 'tm_delete_question');

add_action('admin_action_tm_reset', 'tm_reset_statics');