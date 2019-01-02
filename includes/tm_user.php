<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10.11.2018
 * Time: 21:26
 */

function tm_arraytostr($tm_arr)
{
    $qlt = '';
    if (is_array($tm_arr)) {
        foreach ($tm_arr as $qla) {
            $qlt .= $qla . " ";
        }
        $qlt = trim($qlt);
        return $qlt;
    } else {
        return $tm_arr;
    }
}

function tm_custom_shortcode($atts)
{
    global $wpdb;
    $atts = shortcode_atts(array('id' => ''), $atts, 'testme');

    //Dalsi zpracovani

    $tm_userid = get_current_user_id(); //DOstanu user id
    $tm_quizid = isset($_POST['quizid']) ? (int)$_POST['quizid'] : (int)$atts['id'];
    $tm_quiz = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_quizzes where id = %d", $tm_quizid));
    $tm_all_questions = $wpdb->get_results($wpdb->prepare("select * from " . $wpdb->prefix . "tm_questions where quiz_id = %d", $tm_quizid));
    $tm_alphabet = array('0', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');


    $tm_finished = $wpdb->get_var($wpdb->prepare("select completed from " . $wpdb->prefix . "tm_results 
	where quiz_id = %d and user_id = %d order by id desc limit 1", $tm_quizid, $tm_userid));
    //Если на каждой странице
    if ($tm_quiz->show_type == 'paginated'):
        if ($_POST['send'] != 'Check') {
            $tm_question_number = isset($_POST['number']) ? ($_POST['send'] == 'Start' ? 1 : $_POST['number'])
                : (($tm_quiz->autoload == 1) ? 1 : 0);
            $tm_order = ($tm_quiz->random == 0) ? (isset($_POST['order']) ?
                ($_POST['send'] == 'Start' ? 1 : $_POST['order']) : (($tm_quiz->autoload == 1) ? 1 : 0))
                : rand(1, count($tm_all_questions) - 1);
            if ($_POST['send'] == 'Start') $tm_resume_order = 0;
        }

        $tm_order = (int)$tm_order;
        $tm_right_answers = '';
        $tm_user_answers = '';
        $tm_completed = 0;

        $tm_overall_points = 0;
        foreach ($tm_all_questions as $qlqu) {
            $tm_overall_points += $qlqu->points;
        }


        /*------------------------------------------------------------------------------------------------*/
        $tm_current_question = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_questions 
				where quiz_id = %d and `order` = %d", $tm_quizid, $tm_order));
        $tm_previous_question = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_questions 
				where quiz_id = %d and `order` = %d", $tm_quizid, $tm_order - 1));

        $tm_cintid = $tm_current_question->id;
        $tm_pintid = $tm_previous_question->id;

        $tm_current_question_options = $wpdb->get_results($wpdb->prepare("select * from " . $wpdb->prefix . "tm_answers 
				where question_id = %d", $tm_cintid));

        $tm_right_answers_order = $wpdb->get_results($wpdb->prepare("select `order` from " . $wpdb->prefix . "tm_answers 
				where question_id = %d and right_wrong = 1", $tm_pintid));
        $tm_right_answers_order2 = $wpdb->get_results($wpdb->prepare("select `order` from " . $wpdb->prefix . "tm_answers 
				where question_id = %d and right_wrong = 1", $tm_cintid));
        $tm_prev_id = $_POST['qlo'];
        /*------------------------------------------------------------------------------------------------*/
        if ((isset($_POST['number']) || $tm_quiz->autoload == 1) &&
            ($tm_question_number != $tm_resume_order || $_POST['send'] == 'Check' || $_POST['send'] == 'Next') && !($tm_quiz->autoload == 1 && !isset($_POST['send']) && $tm_finished === '0')):
            $tm_correct = $wpdb->get_var($wpdb->prepare("select correctness_value from " . $wpdb->prefix . "tm_results 
			where question_id = %d and user_id = %d order by id desc limit 1", $tm_cintid, $tm_userid));

            if ($tm_question_number <= count($tm_all_questions)):
                ob_start(); ?>
                <!--Старт теста, сами вопросы -->
                <div class="tm-question card">
                <div class="card-header"><strong><?php echo stripslashes($tm_quiz->name); ?></strong>
                    <p class="tm_question"
                       style="margin: 0px;"><?php echo "Question $tm_order of " . count($tm_all_questions); ?></p>
                    <p class="tm_question"
                       style="margin: 0px;"><?php echo "Points: $tm_current_question->points"; ?></p>
                </div>

                <div class="card-body">
                <?php if (is_singular() || $_POST['singul'] == 'is_single'): ?>
                <!--Вопрос текст -->
                <p class="tm_question_main"><strong><?php echo stripslashes($tm_current_question->text); ?></strong></p>

                <form action="" method="POST" id="tm-start">
                    <input type="hidden" name="action" value="tm_custom_shortcode">
                    <input type="hidden" name="quizid" value="<?php echo $tm_quizid; ?>">
                    <input type="hidden" name="order"
                           value="<?php echo /*($tm_quiz->random == 0) ?*/
                               $tm_order + 1 /*: rand(1, count($tm_all_questions)-1)*/
                           ; ?>">
                    <input type="hidden" name="number" value="<?php echo $tm_question_number + 1; ?>">
                    <input type="hidden" name="qlo" value="<?php echo $tm_current_question->id; ?>">
                    <input type="hidden" name="skip" value="<?php echo $tm_quiz->skip; ?>" id="skip">
                    <?php $i = 1;
                    foreach ($tm_current_question_options as $qcqo) {
                        if ($tm_current_question->answer_type == 'single') {
                            if ($tm_quiz->check_continue != 1 || $_POST['send'] != 'Check') {
                                echo "<p class='tm-option'><input type='radio' name='qlo$tm_current_question->id' 
                            id='c$qcqo->id' class='qlo' value='$qcqo->order'>";
                            }
                        } else {
                            //checkbox = multiply answers
                            if ($tm_quiz->check_continue != 1 || $_POST['send'] != 'Check') {
                                echo "<p class='tm-option'><input type='checkbox' name='qlo$tm_current_question->id[]'
                            id='c$qcqo->id' class='qlo' value='$qcqo->order'>";
                            }
                        }
                        if (!(isset($_POST['send']) && $_POST['send'] == 'Check')) {
                            echo "<label for='c$qcqo->id'>";
                        } else {
                            echo "<label for='c$qcqo->id' style='display:block'>";
                        }
                        if ($tm_quiz->numbering_type == 'numerical') echo $i . $tm_quiz->numbering_mark . ". ";
                        if ($tm_quiz->numbering_type == 'alphabetical') echo $tm_alphabet[$i] . $tm_quiz->numbering_mark . " ";
                        echo $qcqo->text . "</label></p>";
                        $i++;
                    } ?>

                    <?php if ($_POST['send'] == 'Check') {
                        foreach ($_POST as $key => $val) {
                            if (strpos($key, 'qlo') !== false) {
                                $val = tm_arraytostr($val);
                                echo "<input type='hidden' name='$key' value='$val'>";
                            }
                        }
                    } ?>

                    <?php if ($tm_question_number < count($tm_all_questions)): ?>
                        <?php if ($tm_quiz->check_continue != 1 || $_POST['send'] == 'Check'): ?>
                            <!-- Сам тест-->
                            <input type="submit" name="next" value="Next" id="next" class="tm-btn">
                        <?php endif; ?>
                    <?php else: if ($tm_quiz->check_continue != 1 || $_POST['send'] == 'Check'): ?>
                        <input type="submit" name="finish" value="Finish" id="finish" class="tm-btn">
                    <?php endif; endif; ?>

                </form>
                </div>
                </div>

                <?php if ($tm_quiz->time != 0 && $tm_question_number == 1 && $_POST['send'] != 'Check'): ?>
                    <p class="tm-time" id="tm-time"><?php echo $tm_quiz->time; ?></p>
                <?php endif; endif; ?>

                <?php echo ob_get_clean();
            endif;
            if ($tm_question_number > 1 && $_POST['send'] != 'Check'):
                foreach ($tm_right_answers_order as $qrao) {
                    $tm_right_answers .= $qrao->order . " ";
                }
                $tm_user_answers = isset($_POST['qlo' . $tm_prev_id]) ? tm_arraytostr($_POST['qlo' . $tm_prev_id]) : -1;
                $tm_correctness_value = isset($_POST['qlo' . $tm_prev_id]) ? (trim($tm_right_answers) == trim($tm_user_answers)) : -1;
                if ($_POST['send'] == 'Resume') {
                    $_SESSION['tm_points'] = $wpdb->get_var($wpdb->prepare("select points from " . $wpdb->prefix . "tm_results 
			where question_id = %d and user_id = %d order by id desc limit 1", $tm_cintid, $tm_userid));
                }
                if ($tm_correctness_value == 1) {
                    $_SESSION['tm_points'] = $_SESSION['tm_points'] + $tm_previous_question->points;
                }
                if ($tm_question_number == count($tm_all_questions) + 1) {
                    $tm_completed = 1;
                }
            endif;
            if ($tm_question_number > 1 && $_POST['send'] != 'Check' && $tm_question_number > 1
                &&  $_POST['send'] != 'Resume'):
                $tm_date = time();

                $wpdb->insert($wpdb->prefix . 'tm_results',
                    array(
                        'user_id' => $tm_userid,
                        'question_id' => $tm_prev_id,
                        'quiz_id' => $tm_quizid,
                        'user_answer_numbers' => trim($tm_user_answers),
                        'right_answer_numbers' => trim($tm_right_answers),
                        'correctness_value' => $tm_correctness_value,
                        'points' => $_SESSION['tm_points'],
                        'completed' => $tm_completed,
                        'date' => $tm_date
                    ));

            endif;
        endif;
        if ($tm_question_number < 1 || ($tm_finished === '0' && $tm_quiz->resume == 1
                && $tm_question_number == $tm_resume_order && $_POST['send'] != 'Check' && $_POST['send'] != 'Next') || ($tm_quiz->autoload == 1 && !isset($_POST['send']) && $tm_finished === '0')):
            $_SESSION['tm_points'] = 0;
            ob_start(); ?>
            <!-- Первая страница теста-->

            <div class="tm-question card">
            <div class="card-header">
                <strong><?php echo stripslashes($tm_quiz->name); ?></strong>
            </div>
            <div class="card-body">
            <?php if (is_singular()): ?>
            <p class="card-text"><?php echo stripslashes($tm_quiz->description); ?></p>
            <form action="" method="POST" id="tm-start">
                <input type="hidden" name="action" value="tm_custom_shortcode">
                <input type="hidden" name="quizid" value="<?php echo $tm_quizid; ?>">
                <input type="hidden" name="order" value="<?php echo $tm_order + 1; ?>">
                <input type="hidden" name="number" value="<?php echo $tm_question_number + 1; ?>">
                <input type="submit" name="start" value="Start" id="start" class="btn btn-primary">
                <?php if ($tm_quiz->resume == 1 && $tm_quiz->time == 0 && $tm_finished === '0' && $tm_quiz->random == 0): ?>
                    <input type="submit" name="resume" value="Resume" id="resume" class="btn btn-primary">
                <?php endif; ?>
            </form>
            </div>
            </div>

            <?php if ($tm_quiz->time != 0): ?>
                <div id="tm-time" style="display: none;"><?php echo $tm_quiz->time; ?></div>
            <?php endif; endif; ?>

            <?php echo ob_get_clean();
        endif;

        $tm_score = round(($_SESSION['tm_points'] / $tm_overall_points) * 100, 2);

        if ($tm_question_number > count($tm_all_questions)) {

            $wpdb->query($wpdb->prepare("update " . $wpdb->prefix . "tm_quizzes set times_taken = times_taken+1 where id = %d", $tm_quizid));
            $tm_tt = $wpdb->get_var($wpdb->prepare("select times_taken from " . $wpdb->prefix . "tm_quizzes where id = %d", $tm_quizid));
            $tm_sess = $_SESSION['tm_points'];

            $wpdb->query($wpdb->prepare("update " . $wpdb->prefix . "tm_quizzes set avg_percent = 
				(avg_percent * %d + %d) / %d where id = %d", $tm_tt - 1, $tm_score, $tm_tt, $tm_quizid));

            //Конец теста = показывает ошибки
            echo "<div class='tm-finished card'><h3 class='card-header' style='margin-top: 0px; margin-bottom: 0px;'>Overall points: $_SESSION[tm_points] of $tm_overall_points<br>Score: $tm_score%</h2>";
            foreach ($tm_all_questions as $qlaq) {
                $tm_correct = $wpdb->get_var($wpdb->prepare("select correctness_value from " . $wpdb->prefix . "tm_results 
				where question_id = %d and user_id = %d order by id desc limit 1", $qlaq->id, $tm_userid));
                $tm_right_num = $wpdb->get_var($wpdb->prepare("select right_answer_numbers from " . $wpdb->prefix . "tm_results 
				where question_id = %d  and user_id = %d order by id desc limit 1", $qlaq->id, $tm_userid));
                $tm_user_num = $wpdb->get_var($wpdb->prepare("select user_answer_numbers from " . $wpdb->prefix . "tm_results 
				where question_id = %d  and user_id = %d order by id desc limit 1", $qlaq->id, $tm_userid));
                $tm_user_corr_answer = $wpdb->get_var($wpdb->prepare("select text from " . $wpdb->prefix . "tm_answers 
                where question_id = %d and 'order' = %d", $qlaq->id, $tm_right_num));
                $i = 1;
                echo "<div class='card-body' style='border-bottom: #1d2124 solid 1px;'><h5 class='card-title' style='margin-top: 5px;display:inline' >" . stripslashes($qlaq->text) . "</h5>";
                if ($tm_correct == 1) {
                    echo "<p style='color: $tm_quiz->right_color; display:inline;'>(Right)</p>
                            <p style='color: $tm_quiz->right_color'>$qlaq->right_message</p></div>";
                } elseif ($tm_correct == 0) {
                    echo "<p style='color: $tm_quiz->wrong_color; display:inline; font-size: smaller'>(Wrong)</p>
                           <p style='color: $tm_quiz->wrong_color; margin-bottom: 5px;'>You choosed: <strike style='margin-left: 15px;'>$tm_user_num</strike></p>
                           <span style='color: $tm_quiz->right_color; margin-bottom: 5px;'>Correct: <span style='margin-left: 60px'>$tm_right_num </span></span></p>
                           <p style='color: $tm_quiz->wrong_color; display:inline; margin-top: 0px;'>$qlaq->wrong_message</p></div>";
                } else {
                    echo "<p style='color: blue'>Not answered</p></div>";
                }


            }
            $currentdate = date("Y-m-d H:i:s");
            $wpdb->insert($wpdb->prefix . 'tm_result_final',
                array(
                    'quiz_id' => $tm_quizid,
                    'user_id' => $tm_userid,
                    'points' => $tm_score,
                    'date' => $currentdate
                ));
            $url = home_url('/');
            echo "<a href='$url' style='text-align: center; text-decoration: none'><input type='button' name='restart' id='restart' class='next' value='Finish test'></a></div>";
        }
        ob_start(); ?>

        <?php echo ob_get_clean();
    else:
        /* Если все на одной странице  */
        if (!isset($_POST['send'])):

            ob_start(); ?>
            <div class="tm-question card">
            <div class="card-header"><strong><?php echo stripslashes($tm_quiz->name); ?></strong></div>
            <?php if (is_singular()): ?>
            <div class="card-body">
                <p class="card-text"
                   style="border-bottom: #1b1e21 solid 1px; margin-bottom: 0px;"><?php echo stripslashes($tm_quiz->description); ?></p>
                <form method="post">
                    <input type="hidden" name="action" value="tm_custom_shortcode">
                    <input type="hidden" name="quizid" value="<?php echo $tm_quizid; ?>">
                    <input type="hidden" name="skip" value="<?php echo $tm_quiz->skip; ?>" id="skip">
                    <?php foreach ($tm_all_questions as $qlaq): ?>
                        <div class="tm-single">
                            <?php
                            echo "<div class='card-header' style='margin:0px;'>
                              <h5 style='margin-bottom: 0px; margin-top: 5px;'>" . $qlaq->text . "</h5>
                              <p class='tm_question' style='margin-top: 0px;'>Points:" . $qlaq->points . " </p>
                              </div>";
                            $qlaq_options = $wpdb->get_results($wpdb->prepare("select * from " . $wpdb->prefix . "tm_answers 
				        where question_id = %d", $qlaq->id));
                            $i = 1;
                            foreach ($qlaq_options as $qcqo) {
                                if ($qlaq->answer_type == 'single') {
                                    echo "<p class='tm-option'><input type='radio' name='qlo$qlaq->id' id='c$qcqo->id' class='qlo' value='$qcqo->order'>";
                                } else {
                                    echo "<p class='tm-option'><input type='checkbox' name='qlo$qlaq->id[]' id='c$qcqo->id' class='qlo' value='$qcqo->order'>";
                                }
                                echo "<label for='c$qcqo->id'>";
                                if ($tm_quiz->numbering_type == 'numerical') echo $i . $tm_quiz->numbering_mark . ". ";
                                if ($tm_quiz->numbering_type == 'alphabetical') echo $tm_alphabet[$i] . $tm_quiz->numbering_mark . " ";
                                echo $qcqo->text . "</label></p>";
                                $i++;
                            } ?>
                            <input type="hidden" name="qlk<?php echo $qlaq->id; ?>" value="-1">
                        </div>
                    <?php endforeach; ?>
                    <input type="submit" name="finish" value="Finish" id="finish">
                </form>
            </div>
            </div>
            <?php if ($tm_quiz->time != 0): ?>
                <p class="tm-time" id="tm-time"><?php echo $tm_quiz->time; ?></p>
            <?php endif; endif; ?>


            <?php
            echo ob_get_clean();
        else:
            $tm_points = 0;
            $i = 0;

            $tm_overall_points = 0;
            foreach ($tm_all_questions as $qlqu) {
                $tm_overall_points += $qlqu->points;
            }

            foreach ($_POST as $key => $val) {

                if (strpos($key, 'qlk') !== false) {
                    $tm_key = intval(substr($key, 3));
                    $tm_right = $wpdb->get_results($wpdb->prepare("select `order` from " . $wpdb->prefix . "tm_answers 
			where question_id = %d and right_wrong = 1", $tm_key));
                    $tm_single = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_questions 
			where id = %d", $tm_key));

                    $tm_right_answers = '';

                    foreach ($tm_right as $qlr) {
                        $tm_right_answers .= $qlr->order . " ";
                    }

                    if (isset($_POST['qlo' . substr($key, 3)])) {
                        $tm_user_answers = tm_arraytostr($_POST['qlo' . substr($key, 3)]);
                        $tm_correctness_value = (trim($tm_right_answers) == trim($tm_user_answers));
                    } else {
                        $tm_user_answers = -1;
                        $tm_correctness_value = -1;
                    }
                    if ($tm_correctness_value == 1) {
                        $tm_points += $tm_single->points;
                    }
                    $i++;

                    $tm_score = ($tm_points / $tm_overall_points) * 100;
                    if ($i == count($tm_all_questions)) {
                        $tm_completed = 1;

                        $wpdb->query($wpdb->prepare("update " . $wpdb->prefix . "tm_quizzes set times_taken = times_taken+1 where id = %d", $tm_quizid));
                        $tm_tt = $wpdb->get_var($wpdb->prepare("select times_taken from " . $wpdb->prefix . "tm_quizzes where id = %d", $tm_quizid));

                        $wpdb->query($wpdb->prepare("update " . $wpdb->prefix . "tm_quizzes set avg_points = 
				(avg_points * %d + %d) / %d where id = %d", $tm_tt - 1, $tm_points, $tm_tt, $tm_quizid));

                        $wpdb->query($wpdb->prepare("update " . $wpdb->prefix . "tm_quizzes set avg_percent = 
				(avg_percent * %d + %d) / %d where id = %d", $tm_tt - 1, $tm_score, $tm_tt, $tm_quizid));
                    }

                    $wpdb->insert($wpdb->prefix . 'tm_results',
                        array(
                            'user_id' => $tm_userid,
                            'question_id' => substr($key, 3),
                            'quiz_id' => $tm_quizid,
                            'user_answer_numbers' => trim($tm_user_answers),
                            'right_answer_numbers' => trim($tm_right_answers),
                            'correctness_value' => $tm_correctness_value,
                            'points' => $tm_points,
                            'completed' => $tm_completed
                        ));
                }
            }
            //Правильные ответы!!!
            echo "<div class='tm-finished card'><h3 class='card-header' style='margin-top: 0px; margin-bottom: 0px;'>Overall points: $tm_points of $tm_overall_points<br>Score: " . round($tm_score, 2) . "%</h3>";
            foreach ($tm_all_questions as $qlaq) {
                echo "<div class='card-body' style='border-bottom: #1d2124 solid 1px;'><h5 class='card-title' style='margin-top: 5px;display:inline'>" . $qlaq->text . "</h5>";

                $tm_correct = $wpdb->get_var($wpdb->prepare("select correctness_value from " . $wpdb->prefix . "tm_results 
			where question_id = %d  and user_id = %d order by id desc limit 1", $qlaq->id, $tm_userid));
                $tm_right_num = $wpdb->get_var($wpdb->prepare("select right_answer_numbers from " . $wpdb->prefix . "tm_results 
			where question_id = %d  and user_id = %d order by id desc limit 1", $qlaq->id, $tm_userid));
                $tm_user_num = $wpdb->get_var($wpdb->prepare("select user_answer_numbers from " . $wpdb->prefix . "tm_results
			 where question_id = %d  and user_id = %d order by id desc limit 1", $qlaq->id, $tm_userid));

                if ($tm_correct == 1) {
                    echo "<p style='color: $tm_quiz->right_color; display:inline;'>(Right)</p> 
                          <p style='color: $tm_quiz->right_color'> " . $qlaq->right_message . "</p>
                          </div>";
                } elseif ($tm_correct == 0) {
                    echo "  <p style='color: $tm_quiz->wrong_color; display:inline; font-size: smaller'>(Wrong)</p>
                            <p style='color: $tm_quiz->wrong_color; margin-bottom: 5px;'>You choosed: <strike style='margin-left: 15px;'>$tm_user_num</strike></p>
                            <span style='color: $tm_quiz->right_color; margin-bottom: 5px;'>Correct: <span style='margin-left: 60px'>$tm_right_num </span></span></p>
                            <p style='color: $tm_quiz->wrong_color; display:inline; margin-top: 0px;'>$qlaq->wrong_message</p>
                        </div>";
                } else {
                    echo "<div style='color: blue'>Not answered</div></div>";
                }
            }
            $currentdate = date("Y-m-d H:i:s");
            $wpdb->insert($wpdb->prefix . 'tm_result_final',
                array(
                    'quiz_id' => $tm_quizid,
                    'user_id' => $tm_userid,
                    'points' => $tm_score,
                    'date' => $currentdate
                ));
            $url = home_url('/');
            echo "<a href='$url' style='margin-bottom: 5px; text-align: center'><input type='button' name='submit' class='next' id='restart' value='Finish test'></a></div>";
        endif;
    endif;
}

add_shortcode('testme', 'tm_custom_shortcode');
add_action('wp_ajax_tm_custom_shortcode', 'tm_custom_shortcode');
add_action('wp_ajax_nopriv_tm_custom_shortcode', 'tm_custom_shortcode');