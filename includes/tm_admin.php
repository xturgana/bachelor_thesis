<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10.11.2018
 * Time: 21:26
 */


function tm_show_all()
{
    global $wpdb;
    $students_avg = $wpdb->get_var("SELECT AVG(avg_percent) FROM " . $wpdb->prefix . "tm_quizzes where typ_test = 'students'");
    $teachers_avg = $wpdb->get_var("SELECT AVG(avg_percent) FROM " . $wpdb->prefix . "tm_quizzes where typ_test = 'teachers'");
    $firms_avg = $wpdb->get_var("SELECT AVG(avg_percent) FROM " . $wpdb->prefix . "tm_quizzes where typ_test = 'firms'");
    $others_avg = $wpdb->get_var("SELECT AVG(avg_percent) FROM " . $wpdb->prefix . "tm_quizzes where typ_test = 'others'");

    $students_time = $wpdb->get_var("SELECT SUM(times_taken) FROM " . $wpdb->prefix . "tm_quizzes where typ_test = 'students'");
    $teachers_time = $wpdb->get_var("SELECT SUM(times_taken) FROM " . $wpdb->prefix . "tm_quizzes where typ_test = 'teachers'");
    $firms_time = $wpdb->get_var("SELECT SUM(times_taken) FROM " . $wpdb->prefix . "tm_quizzes where typ_test = 'firms'");
    $others_time = $wpdb->get_var("SELECT SUM(times_taken) FROM " . $wpdb->prefix . "tm_quizzes where typ_test = 'others'");

    $student_count = $wpdb->get_var("select count(*) from " . $wpdb->prefix . "tm_questions JOIN " . $wpdb->prefix . "tm_quizzes where wp_tm_quizzes.typ_test = 'students' and wp_tm_quizzes.id = wp_tm_questions.quiz_id");
    $teachers_count = $wpdb->get_var("select count(*) from " . $wpdb->prefix . "tm_questions JOIN " . $wpdb->prefix . "tm_quizzes where wp_tm_quizzes.typ_test = 'teachers' and wp_tm_quizzes.id = wp_tm_questions.quiz_id");
    $firms_count = $wpdb->get_var("select count(*) from " . $wpdb->prefix . "tm_questions JOIN " . $wpdb->prefix . "tm_quizzes where wp_tm_quizzes.typ_test = 'firms' and wp_tm_quizzes.id = wp_tm_questions.quiz_id");
    $others_count = $wpdb->get_var("select count(*) from " . $wpdb->prefix . "tm_questions JOIN " . $wpdb->prefix . "tm_quizzes where wp_tm_quizzes.typ_test = 'others' and wp_tm_quizzes.id = wp_tm_questions.quiz_id");

    $dataPoints = array(
        array("y" => $others_time, "label" => "Others"),
        array("y" => $firms_time, "label" => "Firms"),
        array("y" => $teachers_time, "label" => "Teachers"),
        array("y" => $students_time, "label" => "Students")
    );

    ?>
    <div class="flex-wrapper container">
        <h2 style="text-align: center; margin-top: 70px;">Average results</h2>
        <div class="single-chart">
            <svg viewBox="0 0 36 36" class="circular-chart orange">
                <path class="circle-bg"
                      d="M18 2.0845
                  a 15.9155 15.9155 0 0 1 0 31.831
                  a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <path class="circle"
                      stroke-dasharray="<?php echo $students_avg ?>, 100"
                      d="M18 2.0845
                  a 15.9155 15.9155 0 0 1 0 31.831
                  a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <text x="18" y="20.35" class="percentage"><?php echo round($students_avg) ?>%</text>
            </svg>
            <p style="text-align: center"><a href="<?php echo admin_url("admin.php?page=studenty") ?>">Students</a></p>
        </div>

        <div class="single-chart">
            <svg viewBox="0 0 36 36" class="circular-chart green">
                <path class="circle-bg"
                      d="M18 2.0845
                  a 15.9155 15.9155 0 0 1 0 31.831
                  a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <path class="circle"
                      stroke-dasharray="<?php echo $teachers_avg ?>, 100"
                      d="M18 2.0845
                  a 15.9155 15.9155 0 0 1 0 31.831
                  a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <text x="18" y="20.35" class="percentage"><?php echo round($teachers_avg) ?>%</text>
            </svg>
            <p style="text-align: center"><a href="<?php echo admin_url("admin.php?page=teachers") ?>">Teachers</a></p>
        </div>

        <div class="single-chart">
            <svg viewBox="0 0 36 36" class="circular-chart blue">
                <path class="circle-bg"
                      d="M18 2.0845
                      a 15.9155 15.9155 0 0 1 0 31.831
                      a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <path class="circle"
                      stroke-dasharray="<?php echo $firms_avg ?>, 100"
                      d="M18 2.0845
                      a 15.9155 15.9155 0 0 1 0 31.831
                      a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <text x="18" y="20.35" class="percentage"><?php echo round($firms_avg) ?>%</text>
            </svg>
            <p style="text-align: center"><a href="<?php echo admin_url("admin.php?page=firms") ?>">Firms</a></p>
        </div>
        <div class="single-chart">
            <svg viewBox="0 0 36 36" class="circular-chart red">
                <path class="circle-bg"
                      d="M18 2.0845
                      a 15.9155 15.9155 0 0 1 0 31.831
                      a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <path class="circle"
                      stroke-dasharray="<?php echo $others_avg ?>, 100"
                      d="M18 2.0845
                      a 15.9155 15.9155 0 0 1 0 31.831
                      a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <text x="18" y="20.35" class="percentage"><?php echo round($others_avg) ?>%</text>
            </svg>
            <p style="text-align: center"><a href="<?php echo admin_url("admin.php?page=others") ?>">Others</a></p>
        </div>
    </div>

    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "How many times has the test been passed"
                },
                axisY: {
                    title: "Attempts",
                },
                axisX: {
                    valueFormatString: "#"
                },
                data: [{
                    type: "bar",
                    yValueFormatString: "#0 times",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
    <div class="flex-wrapper container">
        <div id="chartContainer" style="height: 370px; width:70%; margin-top: 15px; "></div>
        <div class="table-count"
             style="width: 250px;border: 1px black solid; margin-top: 10px; margin-left: auto; margin-bottom: 35px; padding-left: 10px;">
            <h2 style="margin-top: 10px; text-align: center; font-weight: bold">Counts of questions</h2>
            <div class="row" style="font-family: Helvetica;">
                <div class="col"
                ">Students
            </div>
            <div class="col" style="border-left: 1px black solid;"><?php echo $student_count; ?></div>
            <div class="w-100"></div>
            <div class="col">Teachers</div>
            <div class="col" style="border-left: 1px black solid"><?php echo $teachers_count; ?></div>
            <div class="w-100"></div>
            <div class="col">Firms:</div>
            <div class="col" style="border-left: 1px black solid"><?php echo $firms_count; ?></div>
            <div class="w-100"></div>
            <div class="col">Others</div>
            <div class="col" style="border-left: 1px black solid"><?php echo $others_count; ?></div>
            <div class="w-100"></div>
            <div class="col-sm-12" style="padding-left: 80px; padding-top: 50px;">
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">

                    <input type="hidden" name="action" value="tm_reset">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"
                            name="delete">
                        Reset statistics
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Reset statistics</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure to reset statistics?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>


    </div>

    </div>

    <?php

}

function tm_show_students()
{
    global $wpdb;
    $tm_quizzes = $wpdb->get_results("select * from " . $wpdb->prefix . "tm_quizzes where typ_test = 'students'");
    foreach ($tm_quizzes as $qlq) {
        $tm_ids[] = $qlq->id;
    }

    $tm_allquestions = $wpdb->get_results("select * from " . $wpdb->prefix . "tm_questions");
    foreach ($tm_allquestions as $qlqt) {
        $tm_qtids[] = $qlqt->id;
    }
    ob_start();

    if ((empty($_GET['id']) || !in_array($_GET['id'], $tm_ids)) &&
        (empty($_GET['questionid']) || (!empty($_GET['questionid']) && !in_array($_GET['questionid'], $tm_qtids)))):
        ?>
        <!--List of test | Add test-->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tabs-1" role="tab"
                   aria-controls="nav-home" aria-selected="true">Show tests</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#tabs-2" role="tab"
                   aria-controls="nav-profile" aria-selected="false">Add test</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tabs-10" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Grafics</a>
            </div>
        </nav>
        <!--List of test | Add test -->
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="tabs-1" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4 style="margin-top: 10px;">Show tests</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_quiz_delete">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Shortcode</th>
                            <th scope="col">Question count</th>
                            <th scope="col">Results</th>
                            <th scope="col">Average Result</th>
                        </tr>

                        <?php
                        foreach ($tm_quizzes as $qlq):?>
                            <tr>
                                <td><input type="checkbox" value="<?php echo $qlq->id; ?>"
                                           name="del<?php echo $qlq->id; ?>"
                                           id="del<?php echo $qlq->id; ?>"><?php echo $qlq->id; ?></td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&id=" . $qlq->id; ?>"><?php echo $qlq->name; ?></a>
                                </td>
                                <td class="qlqid"><?php echo "[testme id=\"" . $qlq->id . "\"]"; ?></td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&id=" . $qlq->id; ?>"><?php echo $wpdb->query($wpdb->prepare("select * from " . $wpdb->prefix . "tm_questions where quiz_id = %d", $qlq->id)); ?></a>
                                </td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&id=" . $qlq->id . "#tabs-9"; ?>">Results</a>
                                </td>
                                <td><?php echo round($qlq->avg_percent, 2) . "%"; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </thead>
                    </table>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"
                            name="delete">
                        Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete test</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Opravdu chcete smazat?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Smazat</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="nav-profile-tab">
                <h4>Add new test</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_insert">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="title" id="title" placeholder="Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="description" id="description" cols="65"
                                      rows="2"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="typetest" id="typetest">
                                <option value="students" selected>Students</option>
                                <option value="teachers">Teachers</option>
                                <option value="firms">Firms</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Numbering type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="numbtype" id="numbtype">
                                <option value="numerical" selected>Numerical</option>
                                <option value="alphabetical">Alphabetical</option>
                                <option value="none">None</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="showtype" class="col-sm-2 col-form-label">Show type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="showtype" id="showtype">
                                <option value="paginated" selected>Each question on its own page</option>
                                <option value="allonone">All questions on one page</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rightcolor" class="col-sm-2 col-form-label">Rigth color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="rightcolor" id="rightcolor" value="00ff00">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="wrongcolor" class="col-sm-2 col-form-label">Wrong color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="wrongcolor" id="wrongcolor" value="ff0000">
                        </div>
                    </div>

                    <div class="form-group row" hidden>
                        <label class="col-sm-2">Random questions</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="random" type="checkbox" id="random">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">Skip questions</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="skip" type="checkbox" id="skip" checked>
                            </div>
                        </div>
                    </div>

                    <p><input type="submit" class="btn btn-primary" name="addquiz" id="addquiz"
                              value="Save"></p>
                </form>
                <div id="dialog" style="display:none;">Please enter quiz title!</div>
            </div>
            <div class="tab-pane fade" id="tabs-10" role="tabpanel" aria-labelledby="nav-contact-tab">
                <h4>Statistics</h4>
                <?php
                $dataPoints = array();

                foreach ($tm_quizzes as $qlq) {
                    array_push($dataPoints, array("y" => round($qlq->avg_percent, 2), "label" => "$qlq->name"));
                }
                ?>

                <script>
                    window.onload = function () {

                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            labelMaxWidth: 100,
                            theme: "light",
                            title: {
                                text: "Tests"
                            },
                            axisY: {
                                title: "Average %"
                            },
                            data: [{
                                type: "column",
                                yValueFormatString: "#,##0.## percent",
                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        chart.render();

                    }
                </script>

                <div id="chartContainer"
                ">
            </div>

        </div>
        </div>

    <?php elseif (!empty($_GET['questionid']) && in_array($_GET['questionid'], $tm_qtids)):
        $tm_intid = (int)$_GET['questionid'];
        $tm_qtrow = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_questions where id = %d", $tm_intid));
        $tm_quizintid = $tm_qtrow->quiz_id;
        $tm_quizrow = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_quizzes where id = %d", $tm_quizintid));
        $wpdb->query($wpdb->prepare("select * from " . $wpdb->prefix . "tm_answers where question_id = %d", $tm_intid));
        $tm_anscount = $wpdb->num_rows; ?>

        <!--Изменить вопрос -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tabs-6" role="tab"
                   aria-controls="nav-home" aria-selected="true">Edit question</a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="tabs-6" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4>Edit question</h4><h4>
                    <a
                            href="<?php echo admin_url("admin.php?page=studenty&id=$tm_quizintid"); ?>">← Back to test
                        "<?php echo $tm_quizrow->name; ?>"</a></h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_question_update">
                    <input type="hidden" name="questionid" value="<?php echo $_GET['questionid']; ?>">
                    <input type="hidden" name="quizid" value="<?php echo $tm_qtrow->quiz_id; ?>">
                    <input type="hidden" name="order" value="<?php echo $tm_qtrow->order; ?>">

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Question</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="text" id="text" cols="65" rows="5"
                                      required><?php echo $tm_qtrow->text; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Correct message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="rightmsg" id="rightmsg" placeholder="Message"
                                   value="<?php echo $tm_qtrow->right_message; ?>">
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Incorrect message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="wrongmsg" id="wrongmsg" placeholder="Message"
                                   value="<?php echo $tm_qtrow->wrong_message; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="points" class="col-sm-2 col-form-label">Points</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="points" id="points" min="0"
                                   value="<?php echo $tm_qtrow->points; ?>">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="anstype" class="col-sm-2 col-form-label">Answer type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="anstype" id="anstype">
                                <option value="single" selected>Sigle choice</option>
                                <option value="multiple">Multiple choice</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" hidden>
                        <label for="ansrand" class="col-sm-2">Random order</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="ansrand" id="ansrand"
                                       type="checkbox" <?php if ($tm_qtrow->answer_random == 1) {
                                    echo "checked";
                                } ?>>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="answers" class="col-sm-2">Answers</label>
                        <div class="col-sm-8">
                            <div class="answers " id="answers">
                                <?php for ($i = 1; $i < $tm_anscount + 1; $i++) {
                                    $tm_answer = $wpdb->get_var($wpdb->prepare("select text from " . $wpdb->prefix .
                                        "tm_answers where `order` = %d and question_id = %d", $i, $tm_intid));
                                    $tm_right = $wpdb->get_var($wpdb->prepare("select `right_wrong` from " . $wpdb->prefix . "tm_answers where `order` = %d and question_id = %d", $i, $tm_intid));
                                    echo "<p><label class='answer col-sm-2' for='answer$i'>Answer $i</label><input name='answer$i' id='answer$i' class='answer' value='$tm_answer' size='78'><button class='delete button'><span class='ui-icon ui-icon-trash'></span></button><button class='addanswer button'><span class='ui-icon ui-icon-plus'></span></button>";
                                    if ($tm_qtrow->answer_type == 'single') {
                                        echo "<input type='radio' class='rw' id='rw$i' name='rw' value='answer$i'";
                                        if ($tm_right == 1) {
                                            echo "checked";
                                        }
                                        echo "></p>";
                                    } else {
                                        echo "<input type='checkbox' class='rw' id='rw$i' name='rw[]' value='answer$i'";
                                        if ($tm_right == 1) {
                                            echo "checked";
                                        }
                                        echo "></p>";
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>


                    <p><input type="submit" class="btn btn-primary" name="addquestion" id="addquestion"
                              value="Update"></p>
                </form>
                <div id="dialog2" style="display:none;">Please enter question text!</div>
                <div id="dialog3" style="display:none;">Please fill all answers!</div>
                <div id="dialog4" style="display:none;">Please select correct answer(s)!</div>
            </div>
        </div>
    <?php
    else: $tm_intid = (int)$_GET['id'];
        $tm_row = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_quizzes where id = %d", $tm_intid)); ?>
        <!--Внутри теста -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tabs-3" role="tab"
                   aria-controls="nav-home" aria-selected="true">Show questions</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#tabs-4" role="tab"
                   aria-controls="nav-profile" aria-selected="false">Add a question</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tabs-5" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Edit test</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tabs-9" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Results</a>

            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="tabs-3" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4><?php echo $tm_row->name; ?></h4><h4><a href="<?php echo admin_url('admin.php?page=studenty'); ?>">←
                        Back to test list</a></h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_question_delete">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th scope="col">Question</th>
                            <th scope="col">Points</th>
                        </tr>
                        </thead>
                        <!-- Список вопросов в тесте -->
                        <?php
                        $tm_questions = $wpdb->get_results($wpdb->prepare("select * from " . $wpdb->prefix .
                            "tm_questions where quiz_id = %d order by `order`", $tm_intid));
                        foreach ($tm_questions as $qlqt): ?>
                            <tr>
                                <td scope="row"><input type="checkbox" name="del<?php echo $qlqt->id; ?>"
                                                       id="del<?php echo $qlqt->id; ?>"
                                                       value="<?php echo $qlqt->id; ?>"></td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&questionid=" . $qlqt->id; ?>"><?php echo strlen($qlqt->text) > 35 ? substr($qlqt->text, 0, 35) . "..." : $qlqt->text; ?></a>
                                </td>
                                <td><?php echo $qlqt->points; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"
                            name="delete">
                        Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete question?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Opravdu chcete smazat?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Smazat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="tabs-4" role="tabpanel" aria-labelledby="nav-profile-tab">
                <h4>Add a question</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_question_insert">
                    <input type="hidden" name="quizid" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="order" value="">


                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Question</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="text" id="text" cols="65" rows="2" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Correct message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="rightmsg" id="rightmsg" placeholder="Message">
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Incorrect message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="wrongmsg" id="wrongmsg" placeholder="Message">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="points" class="col-sm-2 col-form-label">Points</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="points" id="points" min="0" value="1">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="anstype" class="col-sm-2 col-form-label">Answer type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="anstype" id="anstype">
                                <option value="single" selected>Sigle choice</option>
                                <option value="multiple">Multiple choice</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" hidden>
                        <label for="ansrand" class="col-sm-2">Random order</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="ansrand" id="ansrand" type="checkbox">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="answers" class="col-sm-2">Answers</label>
                        <div class="col-sm-8">
                            <div class="answers" id="answers">
                                <?php for ($i = 1; $i < 5; $i++) {
                                    echo "<p><label class='answer col-sm-2' for='answer$i'>Answer $i</label>
                        <input  placeholder='Right answer ' name='answer$i' id='answer$i' class='answer' size='78'><button class='delete button'><span class='ui-icon ui-icon-trash'></span></button><button class='addanswer button'><span class='ui-icon ui-icon-plus'></span></button><input type='radio' class='rw' id='rw$i' name='rw' value='answer$i'></p>";
                                } ?>
                            </div>
                        </div>
                    </div>


                    <p><input type="submit" class="btn btn-primary" name="addquestion" id="addquestion"
                              value="Add"></p>
                </form>
                <div id="dialog2" style="display:none;">Please enter question text!</div>
                <div id="dialog3" style="display:none;">Please fill all answers!</div>
                <div id="dialog4" style="display:none;">Please select correct answer(s)!</div>
            </div>
            <div class="tab-pane fade" id="tabs-5" role="tabpanel" aria-labelledby="nav-contact-tab">
                <h4>Edit test</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_update">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="title" id="title" value="<?php echo $tm_row->name; ?>"
                                   placeholder="Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="description" id="description" cols="65"
                                      rows="2"><?php echo $tm_row->description; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="typetest" id="typetest">
                                <option value="students" <?php if (($tm_row->typ_test) == "students") echo "selected"; ?>>
                                    Students
                                </option>
                                <option value="teachers" <?php if (($tm_row->typ_test) == "teachers") echo "selected"; ?>>
                                    Teachers
                                </option>
                                <option value="firms" <?php if (($tm_row->typ_test) == "firms") echo "selected"; ?>>
                                    Firms
                                </option>
                                <option value="others" <?php if (($tm_row->typ_test) == "others") echo "selected"; ?>>
                                    Others
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Numbering type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="numbtype" id="numbtype">
                                <option value="numerical" <?php if (($tm_row->numbering_type) == "numerical") echo "selected"; ?>>
                                    Numerical
                                </option>
                                <option value="alphabetical" <?php if (($tm_row->numbering_type) == "alphabetical") echo "selected"; ?>>
                                    Alphabetical
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="showtype" class="col-sm-2 col-form-label">Show type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="showtype" id="showtype">
                                <option value="paginated" <?php if (($tm_row->show_type) == "paginated") echo "selected"; ?>>
                                    Each question on its own page
                                </option>
                                <option value="allonone" <?php if (($tm_row->show_type) == "allonone") echo "selected"; ?>>
                                    All questions on one page
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rightcolor" class="col-sm-2 col-form-label">Rigth color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="rightcolor" id="rightcolor"
                                   value="<?php echo substr($tm_row->right_color, 1); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="wrongcolor" class="col-sm-2 col-form-label">Wrong color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="wrongcolor" id="wrongcolor"
                                   value="<?php echo substr($tm_row->wrong_color, 1); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">Skip questions</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="skip" type="checkbox" id="skip"
                                    <?php if ($tm_row->skip == 1) echo "checked"; ?>>
                            </div>
                        </div>
                    </div>

                    <p><input type="submit" class="btn btn-primary" name="addquiz" id="addquiz"
                              value="Update"></p>
                </form>
                <div id="dialog" style="display:none;">Please write test name</div>
            </div>
            <div class="tab-pane fade" id="tabs-9" role="tabpanel" aria-labelledby="nav-contact-tab">
                <h4><?php echo $tm_row->name; ?></h4><h4><a href="<?php echo admin_url('admin.php?page=studenty'); ?>">←
                        Back to test list</a></h4>

                <?php
                $tm_results = $wpdb->get_results($wpdb->prepare("select * from " . $wpdb->prefix .
                    "tm_result_final where quiz_id = %d ORDER by id", $tm_intid));

                $dataPoints = array();

                foreach ($tm_results as $qlr) {
                    array_push($dataPoints, array("y" => $qlr->points));
                }
                ?>

                <script>
                    window.onload = function () {

                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            labelMaxWidth: 100,
                            theme: "light",
                            title: {
                                text: "Tests"
                            },
                            axisX: {},
                            axisY: {
                                title: "Results of tests",
                                maximum: 100
                            },
                            data: [{
                                type: "area",
                                xValueFormatString: "#,## test ",
                                yValueFormatString: "#,##0.## percent",
                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        chart.render();

                    }
                </script>

                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>


        </div>


    <?php endif;
    echo ob_get_clean();
}

function tm_show_teachers()
{
    global $wpdb;
    $tm_quizzes = $wpdb->get_results("select * from " . $wpdb->prefix . "tm_quizzes where typ_test = 'teachers'");
    foreach ($tm_quizzes as $qlq) {
        $tm_ids[] = $qlq->id;
    }

    $tm_allquestions = $wpdb->get_results("select * from " . $wpdb->prefix . "tm_questions");
    foreach ($tm_allquestions as $qlqt) {
        $tm_qtids[] = $qlqt->id;
    }
    ob_start();

    if ((empty($_GET['id']) || !in_array($_GET['id'], $tm_ids)) &&
        (empty($_GET['questionid']) || (!empty($_GET['questionid']) && !in_array($_GET['questionid'], $tm_qtids)))):
        ?>
        <!--List of test | Add test-->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tabs-1" role="tab"
                   aria-controls="nav-home" aria-selected="true">Show tests</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#tabs-2" role="tab"
                   aria-controls="nav-profile" aria-selected="false">Add test</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tabs-10" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Grafics</a>
            </div>
        </nav>
        <!--List of test | Add test -->
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="tabs-1" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4 style="margin-top: 10px;">Show tests</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_quiz_delete">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Shortcode</th>
                            <th scope="col">Question count</th>
                            <th scope="col">Results</th>
                            <th scope="col">Average Result</th>
                        </tr>

                        <?php
                        foreach ($tm_quizzes as $qlq):?>
                            <tr>
                                <td><input type="checkbox" value="<?php echo $qlq->id; ?>"
                                           name="del<?php echo $qlq->id; ?>"
                                           id="del<?php echo $qlq->id; ?>"><?php echo $qlq->id; ?></td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&id=" . $qlq->id; ?>"><?php echo $qlq->name; ?></a>
                                </td>
                                <td class="qlqid"><?php echo "[testme id=\"" . $qlq->id . "\"]"; ?></td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&id=" . $qlq->id; ?>"><?php echo $wpdb->query($wpdb->prepare("select * from " . $wpdb->prefix . "tm_questions where quiz_id = %d", $qlq->id)); ?></a>
                                </td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&id=" . $qlq->id . "#tabs-9"; ?>">Results</a>
                                </td>
                                <td><?php echo round($qlq->avg_percent, 2) . "%"; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </thead>
                    </table>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"
                            name="delete">
                        Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete test</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Opravdu chcete smazat?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Smazat</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="nav-profile-tab">
                <h4>Add new test</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_insert">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="title" id="title" placeholder="Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="description" id="description" cols="65"
                                      rows="2"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="typetest" id="typetest">
                                <option value="students" >Students</option>
                                <option value="teachers" selected>Teachers</option>
                                <option value="firms">Firms</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Numbering type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="numbtype" id="numbtype">
                                <option value="numerical" selected>Numerical</option>
                                <option value="alphabetical">Alphabetical</option>
                                <option value="none">None</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="showtype" class="col-sm-2 col-form-label">Show type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="showtype" id="showtype">
                                <option value="paginated" selected>Each question on its own page</option>
                                <option value="allonone">All questions on one page</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rightcolor" class="col-sm-2 col-form-label">Rigth color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="rightcolor" id="rightcolor" value="00ff00">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="wrongcolor" class="col-sm-2 col-form-label">Wrong color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="wrongcolor" id="wrongcolor" value="ff0000">
                        </div>
                    </div>

                    <div class="form-group row" hidden>
                        <label class="col-sm-2">Random questions</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="random" type="checkbox" id="random">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">Skip questions</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="skip" type="checkbox" id="skip" checked>
                            </div>
                        </div>
                    </div>

                    <p><input type="submit" class="btn btn-primary" name="addquiz" id="addquiz"
                              value="Save"></p>
                </form>
                <div id="dialog" style="display:none;">Please enter quiz title!</div>
            </div>
            <div class="tab-pane fade" id="tabs-10" role="tabpanel" aria-labelledby="nav-contact-tab">
                <h4>Statistics</h4>
                <?php
                $dataPoints = array();

                foreach ($tm_quizzes as $qlq) {
                    array_push($dataPoints, array("y" => round($qlq->avg_percent, 2), "label" => "$qlq->name"));
                }
                ?>

                <script>
                    window.onload = function () {

                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            labelMaxWidth: 100,
                            theme: "light",
                            title: {
                                text: "Tests"
                            },
                            axisY: {
                                title: "Average %"
                            },
                            data: [{
                                type: "column",
                                yValueFormatString: "#,##0.## percent",
                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        chart.render();

                    }
                </script>

                <div id="chartContainer"
                ">
            </div>

        </div>
        </div>

    <?php elseif (!empty($_GET['questionid']) && in_array($_GET['questionid'], $tm_qtids)):
        $tm_intid = (int)$_GET['questionid'];
        $tm_qtrow = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_questions where id = %d", $tm_intid));
        $tm_quizintid = $tm_qtrow->quiz_id;
        $tm_quizrow = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_quizzes where id = %d", $tm_quizintid));
        $wpdb->query($wpdb->prepare("select * from " . $wpdb->prefix . "tm_answers where question_id = %d", $tm_intid));
        $tm_anscount = $wpdb->num_rows; ?>

        <!--Изменить вопрос -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tabs-6" role="tab"
                   aria-controls="nav-home" aria-selected="true">Edit question</a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="tabs-6" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4>Edit question</h4><h4>
                    <a
                            href="<?php echo admin_url("admin.php?page=teachers&id=$tm_quizintid"); ?>">← Back to test
                        "<?php echo $tm_quizrow->name; ?>"</a></h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_question_update">
                    <input type="hidden" name="questionid" value="<?php echo $_GET['questionid']; ?>">
                    <input type="hidden" name="quizid" value="<?php echo $tm_qtrow->quiz_id; ?>">
                    <input type="hidden" name="order" value="<?php echo $tm_qtrow->order; ?>">

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Question</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="text" id="text" cols="65" rows="5"
                                      required><?php echo $tm_qtrow->text; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Correct message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="rightmsg" id="rightmsg" placeholder="Message"
                                   value="<?php echo $tm_qtrow->right_message; ?>">
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Incorrect message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="wrongmsg" id="wrongmsg" placeholder="Message"
                                   value="<?php echo $tm_qtrow->wrong_message; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="points" class="col-sm-2 col-form-label">Points</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="points" id="points" min="0"
                                   value="<?php echo $tm_qtrow->points; ?>">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="anstype" class="col-sm-2 col-form-label">Answer type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="anstype" id="anstype">
                                <option value="single" selected>Sigle choice</option>
                                <option value="multiple">Multiple choice</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" hidden>
                        <label for="ansrand" class="col-sm-2">Random order</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="ansrand" id="ansrand"
                                       type="checkbox" <?php if ($tm_qtrow->answer_random == 1) {
                                    echo "checked";
                                } ?>>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="answers" class="col-sm-2">Answers</label>
                        <div class="col-sm-8">
                            <div class="answers " id="answers">
                                <?php for ($i = 1; $i < $tm_anscount + 1; $i++) {
                                    $tm_answer = $wpdb->get_var($wpdb->prepare("select text from " . $wpdb->prefix .
                                        "tm_answers where `order` = %d and question_id = %d", $i, $tm_intid));
                                    $tm_right = $wpdb->get_var($wpdb->prepare("select `right_wrong` from " . $wpdb->prefix . "tm_answers where `order` = %d and question_id = %d", $i, $tm_intid));
                                    echo "<p><label class='answer col-sm-2' for='answer$i'>Answer $i</label><input name='answer$i' id='answer$i' class='answer' value='$tm_answer' size='78'><button class='delete button'><span class='ui-icon ui-icon-trash'></span></button><button class='addanswer button'><span class='ui-icon ui-icon-plus'></span></button>";
                                    if ($tm_qtrow->answer_type == 'single') {
                                        echo "<input type='radio' class='rw' id='rw$i' name='rw' value='answer$i'";
                                        if ($tm_right == 1) {
                                            echo "checked";
                                        }
                                        echo "></p>";
                                    } else {
                                        echo "<input type='checkbox' class='rw' id='rw$i' name='rw[]' value='answer$i'";
                                        if ($tm_right == 1) {
                                            echo "checked";
                                        }
                                        echo "></p>";
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>


                    <p><input type="submit" class="btn btn-primary" name="addquestion" id="addquestion"
                              value="Update"></p>
                </form>
                <div id="dialog2" style="display:none;">Please enter question text!</div>
                <div id="dialog3" style="display:none;">Please fill all answers!</div>
                <div id="dialog4" style="display:none;">Please select correct answer(s)!</div>
            </div>
        </div>
    <?php
    else: $tm_intid = (int)$_GET['id'];
        $tm_row = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_quizzes where id = %d", $tm_intid)); ?>
        <!--Внутри теста -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tabs-3" role="tab"
                   aria-controls="nav-home" aria-selected="true">Show questions</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#tabs-4" role="tab"
                   aria-controls="nav-profile" aria-selected="false">Add a question</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tabs-5" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Edit test</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tabs-9" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Results</a>

            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="tabs-3" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4><?php echo $tm_row->name; ?></h4><h4><a href="<?php echo admin_url('admin.php?page=teachers'); ?>">←
                        Back to test list</a></h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_question_delete">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Question</th>
                            <th scope="col">Points</th>
                        </tr>
                        </thead>
                        <!-- Список вопросов в тесте -->
                        <?php
                        $tm_questions = $wpdb->get_results($wpdb->prepare("select * from " . $wpdb->prefix .
                            "tm_questions where quiz_id = %d order by `order`", $tm_intid));
                        foreach ($tm_questions as $qlqt): ?>
                            <tr>
                                <td scope="row"><input type="checkbox" name="del<?php echo $qlqt->id; ?>"
                                                       id="del<?php echo $qlqt->id; ?>"
                                                       value="<?php echo $qlqt->id; ?>">
                                </td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&questionid=" . $qlqt->id; ?>"><?php echo strlen($qlqt->text) > 35 ? substr($qlqt->text, 0, 35) . "..." : $qlqt->text; ?></a>
                                </td>
                                <td><?php echo $qlqt->points; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"
                            name="delete">
                        Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete question?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Opravdu chcete smazat?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Smazat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="tabs-4" role="tabpanel" aria-labelledby="nav-profile-tab">
                <h4>Add a question</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_question_insert">
                    <input type="hidden" name="quizid" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="order" value="">


                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Question</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="text" id="text" cols="65" rows="2" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Correct message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="rightmsg" id="rightmsg" placeholder="Message">
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Incorrect message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="wrongmsg" id="wrongmsg" placeholder="Message">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="points" class="col-sm-2 col-form-label">Points</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="points" id="points" min="0" value="1">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="anstype" class="col-sm-2 col-form-label">Answer type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="anstype" id="anstype">
                                <option value="single" selected>Sigle choice</option>
                                <option value="multiple">Multiple choice</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" hidden>
                        <label for="ansrand" class="col-sm-2">Random order</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="ansrand" id="ansrand" type="checkbox">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="answers" class="col-sm-2">Answers</label>
                        <div class="col-sm-8">
                            <div class="answers" id="answers">
                                <?php for ($i = 1; $i < 5; $i++) {
                                    echo "<p><label class='answer col-sm-2' for='answer$i'>Answer $i</label>
                        <input  placeholder='Right answer ' name='answer$i' id='answer$i' class='answer' size='78'><button class='delete button'><span class='ui-icon ui-icon-trash'></span></button><button class='addanswer button'><span class='ui-icon ui-icon-plus'></span></button><input type='radio' class='rw' id='rw$i' name='rw' value='answer$i'></p>";
                                } ?>
                            </div>
                        </div>
                    </div>


                    <p><input type="submit" class="btn btn-primary" name="addquestion" id="addquestion"
                              value="Add"></p>
                </form>
                <div id="dialog2" style="display:none;">Please enter question text!</div>
                <div id="dialog3" style="display:none;">Please fill all answers!</div>
                <div id="dialog4" style="display:none;">Please select correct answer(s)!</div>
            </div>
            <div class="tab-pane fade" id="tabs-5" role="tabpanel" aria-labelledby="nav-contact-tab">
                <h4>Edit test</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_update">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="title" id="title" value="<?php echo $tm_row->name; ?>"
                                   placeholder="Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="description" id="description" cols="65"
                                      rows="2"><?php echo $tm_row->description; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="typetest" id="typetest">
                                <option value="students" <?php if (($tm_row->typ_test) == "students") echo "selected"; ?>>
                                    Students
                                </option>
                                <option value="teachers" <?php if (($tm_row->typ_test) == "teachers") echo "selected"; ?>>
                                    Teachers
                                </option>
                                <option value="firms" <?php if (($tm_row->typ_test) == "firms") echo "selected"; ?>>
                                    Firms
                                </option>
                                <option value="others" <?php if (($tm_row->typ_test) == "others") echo "selected"; ?>>
                                    Others
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Numbering type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="numbtype" id="numbtype">
                                <option value="numerical" <?php if (($tm_row->numbering_type) == "numerical") echo "selected"; ?>>
                                    Numerical
                                </option>
                                <option value="alphabetical" <?php if (($tm_row->numbering_type) == "alphabetical") echo "selected"; ?>>
                                    Alphabetical
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="showtype" class="col-sm-2 col-form-label">Show type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="showtype" id="showtype">
                                <option value="paginated" <?php if (($tm_row->show_type) == "paginated") echo "selected"; ?>>
                                    Each question on its own page
                                </option>
                                <option value="allonone" <?php if (($tm_row->show_type) == "allonone") echo "selected"; ?>>
                                    All questions on one page
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rightcolor" class="col-sm-2 col-form-label">Rigth color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="rightcolor" id="rightcolor"
                                   value="<?php echo substr($tm_row->right_color, 1); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="wrongcolor" class="col-sm-2 col-form-label">Wrong color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="wrongcolor" id="wrongcolor"
                                   value="<?php echo substr($tm_row->wrong_color, 1); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">Skip questions</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="skip" type="checkbox" id="skip"
                                    <?php if ($tm_row->skip == 1) echo "checked"; ?>>
                            </div>
                        </div>
                    </div>

                    <p><input type="submit" class="btn btn-primary" name="addquiz" id="addquiz"
                              value="Update"></p>
                </form>
                <div id="dialog" style="display:none;">Please write test name</div>
            </div>
            <div class="tab-pane fade" id="tabs-9" role="tabpanel" aria-labelledby="nav-contact-tab">
                <h4><?php echo $tm_row->name; ?></h4><h4><a href="<?php echo admin_url('admin.php?page=teachers'); ?>">←
                        Back to test list</a></h4>

                <?php
                $tm_results = $wpdb->get_results($wpdb->prepare("select * from " . $wpdb->prefix .
                    "tm_result_final where quiz_id = %d ORDER by id", $tm_intid));

                $dataPoints = array();

                foreach ($tm_results as $qlr) {
                    array_push($dataPoints, array("y" => $qlr->points));
                }
                ?>

                <script>
                    window.onload = function () {

                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            labelMaxWidth: 100,
                            theme: "light",
                            title: {
                                text: "Tests"
                            },
                            axisX: {},
                            axisY: {
                                title: "Results of tests",
                                maximum: 100
                            },
                            data: [{
                                type: "area",
                                xValueFormatString: "#,## test ",
                                yValueFormatString: "#,##0.## percent",
                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        chart.render();

                    }
                </script>

                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>


        </div>


    <?php endif;
    echo ob_get_clean();
}

function tm_show_firms()
{
    global $wpdb;
    $tm_quizzes = $wpdb->get_results("select * from " . $wpdb->prefix . "tm_quizzes where typ_test = 'firms'");
    foreach ($tm_quizzes as $qlq) {
        $tm_ids[] = $qlq->id;
    }

    $tm_allquestions = $wpdb->get_results("select * from " . $wpdb->prefix . "tm_questions");
    foreach ($tm_allquestions as $qlqt) {
        $tm_qtids[] = $qlqt->id;
    }
    ob_start();

    if ((empty($_GET['id']) || !in_array($_GET['id'], $tm_ids)) &&
        (empty($_GET['questionid']) || (!empty($_GET['questionid']) && !in_array($_GET['questionid'], $tm_qtids)))):
        ?>
        <!--List of test | Add test-->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tabs-1" role="tab"
                   aria-controls="nav-home" aria-selected="true">Show tests</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#tabs-2" role="tab"
                   aria-controls="nav-profile" aria-selected="false">Add test</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tabs-10" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Grafics</a>
            </div>
        </nav>
        <!--List of test | Add test -->
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="tabs-1" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4 style="margin-top: 10px;">Show tests</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_quiz_delete">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Shortcode</th>
                            <th scope="col">Question count</th>
                            <th scope="col">Results</th>
                            <th scope="col">Average Result</th>
                        </tr>

                        <?php
                        foreach ($tm_quizzes as $qlq):?>
                            <tr>
                                <td><input type="checkbox" value="<?php echo $qlq->id; ?>"
                                           name="del<?php echo $qlq->id; ?>"
                                           id="del<?php echo $qlq->id; ?>"><?php echo $qlq->id; ?></td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&id=" . $qlq->id; ?>"><?php echo $qlq->name; ?></a>
                                </td>
                                <td class="qlqid"><?php echo "[testme id=\"" . $qlq->id . "\"]"; ?></td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&id=" . $qlq->id; ?>"><?php echo $wpdb->query($wpdb->prepare("select * from " . $wpdb->prefix . "tm_questions where quiz_id = %d", $qlq->id)); ?></a>
                                </td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&id=" . $qlq->id . "#tabs-9"; ?>">Results</a>
                                </td>
                                <td><?php echo round($qlq->avg_percent, 2) . "%"; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </thead>
                    </table>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"
                            name="delete">
                        Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete test</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Opravdu chcete smazat?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Smazat</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="nav-profile-tab">
                <h4>Add new test</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_insert">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="title" id="title" placeholder="Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="description" id="description" cols="65"
                                      rows="2"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="typetest" id="typetest">
                                <option value="students" >Students</option>
                                <option value="teachers">Teachers</option>
                                <option value="firms" selected>Firms</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Numbering type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="numbtype" id="numbtype">
                                <option value="numerical" selected>Numerical</option>
                                <option value="alphabetical">Alphabetical</option>
                                <option value="none">None</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="showtype" class="col-sm-2 col-form-label">Show type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="showtype" id="showtype">
                                <option value="paginated" selected>Each question on its own page</option>
                                <option value="allonone">All questions on one page</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rightcolor" class="col-sm-2 col-form-label">Rigth color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="rightcolor" id="rightcolor" value="00ff00">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="wrongcolor" class="col-sm-2 col-form-label">Wrong color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="wrongcolor" id="wrongcolor" value="ff0000">
                        </div>
                    </div>

                    <div class="form-group row" hidden>
                        <label class="col-sm-2">Random questions</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="random" type="checkbox" id="random">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">Skip questions</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="skip" type="checkbox" id="skip" checked>
                            </div>
                        </div>
                    </div>

                    <p><input type="submit" class="btn btn-primary" name="addquiz" id="addquiz"
                              value="Save"></p>
                </form>
                <div id="dialog" style="display:none;">Please enter quiz title!</div>
            </div>
            <div class="tab-pane fade" id="tabs-10" role="tabpanel" aria-labelledby="nav-contact-tab">
                <h4>Statistics</h4>
                <?php
                $dataPoints = array();

                foreach ($tm_quizzes as $qlq) {
                    array_push($dataPoints, array("y" => round($qlq->avg_percent, 2), "label" => "$qlq->name"));
                }
                ?>

                <script>
                    window.onload = function () {

                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            labelMaxWidth: 100,
                            theme: "light",
                            title: {
                                text: "Tests"
                            },
                            axisY: {
                                title: "Average %"
                            },
                            data: [{
                                type: "column",
                                yValueFormatString: "#,##0.## percent",
                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        chart.render();

                    }
                </script>

                <div id="chartContainer"
                ">
            </div>

        </div>
        </div>

    <?php elseif (!empty($_GET['questionid']) && in_array($_GET['questionid'], $tm_qtids)):
        $tm_intid = (int)$_GET['questionid'];
        $tm_qtrow = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_questions where id = %d", $tm_intid));
        $tm_quizintid = $tm_qtrow->quiz_id;
        $tm_quizrow = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_quizzes where id = %d", $tm_quizintid));
        $wpdb->query($wpdb->prepare("select * from " . $wpdb->prefix . "tm_answers where question_id = %d", $tm_intid));
        $tm_anscount = $wpdb->num_rows; ?>

        <!--Изменить вопрос -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tabs-6" role="tab"
                   aria-controls="nav-home" aria-selected="true">Edit question</a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="tabs-6" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4>Edit question</h4><h4>
                    <a
                            href="<?php echo admin_url("admin.php?page=firms&id=$tm_quizintid"); ?>">← Back to test
                        "<?php echo $tm_quizrow->name; ?>"</a></h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_question_update">
                    <input type="hidden" name="questionid" value="<?php echo $_GET['questionid']; ?>">
                    <input type="hidden" name="quizid" value="<?php echo $tm_qtrow->quiz_id; ?>">
                    <input type="hidden" name="order" value="<?php echo $tm_qtrow->order; ?>">

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Question</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="text" id="text" cols="65" rows="5"
                                      required><?php echo $tm_qtrow->text; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Correct message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="rightmsg" id="rightmsg" placeholder="Message"
                                   value="<?php echo $tm_qtrow->right_message; ?>">
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Incorrect message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="wrongmsg" id="wrongmsg" placeholder="Message"
                                   value="<?php echo $tm_qtrow->wrong_message; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="points" class="col-sm-2 col-form-label">Points</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="points" id="points" min="0"
                                   value="<?php echo $tm_qtrow->points; ?>">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="anstype" class="col-sm-2 col-form-label">Answer type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="anstype" id="anstype">
                                <option value="single" selected>Sigle choice</option>
                                <option value="multiple">Multiple choice</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" hidden>
                        <label for="ansrand" class="col-sm-2">Random order</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="ansrand" id="ansrand"
                                       type="checkbox" <?php if ($tm_qtrow->answer_random == 1) {
                                    echo "checked";
                                } ?>>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="answers" class="col-sm-2">Answers</label>
                        <div class="col-sm-8">
                            <div class="answers " id="answers">
                                <?php for ($i = 1; $i < $tm_anscount + 1; $i++) {
                                    $tm_answer = $wpdb->get_var($wpdb->prepare("select text from " . $wpdb->prefix .
                                        "tm_answers where `order` = %d and question_id = %d", $i, $tm_intid));
                                    $tm_right = $wpdb->get_var($wpdb->prepare("select `right_wrong` from " . $wpdb->prefix . "tm_answers where `order` = %d and question_id = %d", $i, $tm_intid));
                                    echo "<p><label class='answer col-sm-2' for='answer$i'>Answer $i</label><input name='answer$i' id='answer$i' class='answer' value='$tm_answer' size='78'><button class='delete button'><span class='ui-icon ui-icon-trash'></span></button><button class='addanswer button'><span class='ui-icon ui-icon-plus'></span></button>";
                                    if ($tm_qtrow->answer_type == 'single') {
                                        echo "<input type='radio' class='rw' id='rw$i' name='rw' value='answer$i'";
                                        if ($tm_right == 1) {
                                            echo "checked";
                                        }
                                        echo "></p>";
                                    } else {
                                        echo "<input type='checkbox' class='rw' id='rw$i' name='rw[]' value='answer$i'";
                                        if ($tm_right == 1) {
                                            echo "checked";
                                        }
                                        echo "></p>";
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>


                    <p><input type="submit" class="btn btn-primary" name="addquestion" id="addquestion"
                              value="Update"></p>
                </form>
                <div id="dialog2" style="display:none;">Please enter question text!</div>
                <div id="dialog3" style="display:none;">Please fill all answers!</div>
                <div id="dialog4" style="display:none;">Please select correct answer(s)!</div>
            </div>
        </div>
    <?php
    else: $tm_intid = (int)$_GET['id'];
        $tm_row = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_quizzes where id = %d", $tm_intid)); ?>
        <!--Внутри теста -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tabs-3" role="tab"
                   aria-controls="nav-home" aria-selected="true">Show questions</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#tabs-4" role="tab"
                   aria-controls="nav-profile" aria-selected="false">Add a question</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tabs-5" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Edit test</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tabs-9" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Results</a>

            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="tabs-3" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4><?php echo $tm_row->name; ?></h4><h4><a href="<?php echo admin_url('admin.php?page=firms'); ?>">←
                        Back to test list</a></h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_question_delete">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Question</th>
                            <th scope="col">Points</th>
                        </tr>
                        </thead>
                        <!-- Список вопросов в тесте -->
                        <?php
                        $tm_questions = $wpdb->get_results($wpdb->prepare("select * from " . $wpdb->prefix .
                            "tm_questions where quiz_id = %d order by `order`", $tm_intid));
                        foreach ($tm_questions as $qlqt): ?>
                            <tr>
                                <td scope="row"><input type="checkbox" name="del<?php echo $qlqt->id; ?>"
                                                       id="del<?php echo $qlqt->id; ?>"
                                                       value="<?php echo $qlqt->id; ?>">
                                </td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&questionid=" . $qlqt->id; ?>"><?php echo strlen($qlqt->text) > 35 ? substr($qlqt->text, 0, 35) . "..." : $qlqt->text; ?></a>
                                </td>
                                <td><?php echo $qlqt->points; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"
                            name="delete">
                        Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete question?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Opravdu chcete smazat?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Smazat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="tabs-4" role="tabpanel" aria-labelledby="nav-profile-tab">
                <h4>Add a question</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_question_insert">
                    <input type="hidden" name="quizid" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="order" value="">


                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Question</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="text" id="text" cols="65" rows="2" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Correct message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="rightmsg" id="rightmsg" placeholder="Message">
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Incorrect message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="wrongmsg" id="wrongmsg" placeholder="Message">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="points" class="col-sm-2 col-form-label">Points</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="points" id="points" min="0" value="1">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="anstype" class="col-sm-2 col-form-label">Answer type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="anstype" id="anstype">
                                <option value="single" selected>Sigle choice</option>
                                <option value="multiple">Multiple choice</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" hidden>
                        <label for="ansrand" class="col-sm-2">Random order</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="ansrand" id="ansrand" type="checkbox">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="answers" class="col-sm-2">Answers</label>
                        <div class="col-sm-8">
                            <div class="answers" id="answers">
                                <?php for ($i = 1; $i < 5; $i++) {
                                    echo "<p><label class='answer col-sm-2' for='answer$i'>Answer $i</label>
                        <input  placeholder='Right answer ' name='answer$i' id='answer$i' class='answer' size='78'><button class='delete button'><span class='ui-icon ui-icon-trash'></span></button><button class='addanswer button'><span class='ui-icon ui-icon-plus'></span></button><input type='radio' class='rw' id='rw$i' name='rw' value='answer$i'></p>";
                                } ?>
                            </div>
                        </div>
                    </div>


                    <p><input type="submit" class="btn btn-primary" name="addquestion" id="addquestion"
                              value="Add"></p>
                </form>
                <div id="dialog2" style="display:none;">Please enter question text!</div>
                <div id="dialog3" style="display:none;">Please fill all answers!</div>
                <div id="dialog4" style="display:none;">Please select correct answer(s)!</div>
            </div>
            <div class="tab-pane fade" id="tabs-5" role="tabpanel" aria-labelledby="nav-contact-tab">
                <h4>Edit test</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_update">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="title" id="title" value="<?php echo $tm_row->name; ?>"
                                   placeholder="Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="description" id="description" cols="65"
                                      rows="2"><?php echo $tm_row->description; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="typetest" id="typetest">
                                <option value="students" <?php if (($tm_row->typ_test) == "students") echo "selected"; ?>>
                                    Students
                                </option>
                                <option value="teachers" <?php if (($tm_row->typ_test) == "teachers") echo "selected"; ?>>
                                    Teachers
                                </option>
                                <option value="firms" <?php if (($tm_row->typ_test) == "firms") echo "selected"; ?>>
                                    Firms
                                </option>
                                <option value="others" <?php if (($tm_row->typ_test) == "others") echo "selected"; ?>>
                                    Others
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Numbering type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="numbtype" id="numbtype">
                                <option value="numerical" <?php if (($tm_row->numbering_type) == "numerical") echo "selected"; ?>>
                                    Numerical
                                </option>
                                <option value="alphabetical" <?php if (($tm_row->numbering_type) == "alphabetical") echo "selected"; ?>>
                                    Alphabetical
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="showtype" class="col-sm-2 col-form-label">Show type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="showtype" id="showtype">
                                <option value="paginated" <?php if (($tm_row->show_type) == "paginated") echo "selected"; ?>>
                                    Each question on its own page
                                </option>
                                <option value="allonone" <?php if (($tm_row->show_type) == "allonone") echo "selected"; ?>>
                                    All questions on one page
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rightcolor" class="col-sm-2 col-form-label">Rigth color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="rightcolor" id="rightcolor"
                                   value="<?php echo substr($tm_row->right_color, 1); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="wrongcolor" class="col-sm-2 col-form-label">Wrong color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="wrongcolor" id="wrongcolor"
                                   value="<?php echo substr($tm_row->wrong_color, 1); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">Skip questions</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="skip" type="checkbox" id="skip"
                                    <?php if ($tm_row->skip == 1) echo "checked"; ?>>
                            </div>
                        </div>
                    </div>

                    <p><input type="submit" class="btn btn-primary" name="addquiz" id="addquiz"
                              value="Update"></p>
                </form>
                <div id="dialog" style="display:none;">Please write test name</div>
            </div>
            <div class="tab-pane fade" id="tabs-9" role="tabpanel" aria-labelledby="nav-contact-tab">
                <h4><?php echo $tm_row->name; ?></h4><h4><a href="<?php echo admin_url('admin.php?page=firms'); ?>">←
                        Back to test list</a></h4>

                <?php
                $tm_results = $wpdb->get_results($wpdb->prepare("select * from " . $wpdb->prefix .
                    "tm_result_final where quiz_id = %d ORDER by id", $tm_intid));

                $dataPoints = array();

                foreach ($tm_results as $qlr) {
                    array_push($dataPoints, array("y" => $qlr->points));
                }
                ?>

                <script>
                    window.onload = function () {

                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            labelMaxWidth: 100,
                            theme: "light",
                            title: {
                                text: "Tests"
                            },
                            axisX: {},
                            axisY: {
                                title: "Results of tests",
                                maximum: 100
                            },
                            data: [{
                                type: "area",
                                xValueFormatString: "#,## test ",
                                yValueFormatString: "#,##0.## percent",
                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        chart.render();

                    }
                </script>

                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>


        </div>


    <?php endif;
    echo ob_get_clean();
}

function tm_show_others()
{
    global $wpdb;
    $tm_quizzes = $wpdb->get_results("select * from " . $wpdb->prefix . "tm_quizzes where typ_test = 'others'");
    foreach ($tm_quizzes as $qlq) {
        $tm_ids[] = $qlq->id;
    }

    $tm_allquestions = $wpdb->get_results("select * from " . $wpdb->prefix . "tm_questions");
    foreach ($tm_allquestions as $qlqt) {
        $tm_qtids[] = $qlqt->id;
    }
    ob_start();

    if ((empty($_GET['id']) || !in_array($_GET['id'], $tm_ids)) &&
        (empty($_GET['questionid']) || (!empty($_GET['questionid']) && !in_array($_GET['questionid'], $tm_qtids)))):
        ?>
        <!--List of test | Add test-->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tabs-1" role="tab"
                   aria-controls="nav-home" aria-selected="true">Show tests</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#tabs-2" role="tab"
                   aria-controls="nav-profile" aria-selected="false">Add test</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tabs-10" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Grafics</a>
            </div>
        </nav>
        <!--List of test | Add test -->
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="tabs-1" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4 style="margin-top: 10px;">Show tests</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_quiz_delete">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Shortcode</th>
                            <th scope="col">Question count</th>
                            <th scope="col">Results</th>
                            <th scope="col">Average Result</th>
                        </tr>

                        <?php
                        foreach ($tm_quizzes as $qlq):?>
                            <tr>
                                <td><input type="checkbox" value="<?php echo $qlq->id; ?>"
                                           name="del<?php echo $qlq->id; ?>"
                                           id="del<?php echo $qlq->id; ?>"><?php echo $qlq->id; ?></td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&id=" . $qlq->id; ?>"><?php echo $qlq->name; ?></a>
                                </td>
                                <td class="qlqid"><?php echo "[testme id=\"" . $qlq->id . "\"]"; ?></td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&id=" . $qlq->id; ?>"><?php echo $wpdb->query($wpdb->prepare("select * from " . $wpdb->prefix . "tm_questions where quiz_id = %d", $qlq->id)); ?></a>
                                </td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&id=" . $qlq->id . "#tabs-9"; ?>">Results</a>
                                </td>
                                <td><?php echo round($qlq->avg_percent, 2) . "%"; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </thead>
                    </table>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"
                            name="delete">
                        Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete test</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Opravdu chcete smazat?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Smazat</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="nav-profile-tab">
                <h4>Add new test</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_insert">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="title" id="title" placeholder="Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="description" id="description" cols="65"
                                      rows="2"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="typetest" id="typetest">
                                <option value="students" >Students</option>
                                <option value="teachers">Teachers</option>
                                <option value="firms">Firms</option>
                                <option value="others" selected>Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Numbering type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="numbtype" id="numbtype">
                                <option value="numerical" selected>Numerical</option>
                                <option value="alphabetical">Alphabetical</option>
                                <option value="none">None</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="showtype" class="col-sm-2 col-form-label">Show type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="showtype" id="showtype">
                                <option value="paginated" selected>Each question on its own page</option>
                                <option value="allonone">All questions on one page</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rightcolor" class="col-sm-2 col-form-label">Rigth color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="rightcolor" id="rightcolor" value="00ff00">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="wrongcolor" class="col-sm-2 col-form-label">Wrong color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="wrongcolor" id="wrongcolor" value="ff0000">
                        </div>
                    </div>

                    <div class="form-group row" hidden>
                        <label class="col-sm-2">Random questions</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="random" type="checkbox" id="random">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">Skip questions</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="skip" type="checkbox" id="skip" checked>
                            </div>
                        </div>
                    </div>

                    <p><input type="submit" class="btn btn-primary" name="addquiz" id="addquiz"
                              value="Save"></p>
                </form>
                <div id="dialog" style="display:none;">Please enter quiz title!</div>
            </div>
            <div class="tab-pane fade" id="tabs-10" role="tabpanel" aria-labelledby="nav-contact-tab">
                <h4>Statistics</h4>
                <?php
                $dataPoints = array();

                foreach ($tm_quizzes as $qlq) {
                    array_push($dataPoints, array("y" => round($qlq->avg_percent, 2), "label" => "$qlq->name"));
                }
                ?>

                <script>
                    window.onload = function () {

                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            labelMaxWidth: 100,
                            theme: "light",
                            title: {
                                text: "Tests"
                            },
                            axisY: {
                                title: "Average %"
                            },
                            data: [{
                                type: "column",
                                yValueFormatString: "#,##0.## percent",
                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        chart.render();

                    }
                </script>

                <div id="chartContainer"
                ">
            </div>

        </div>
        </div>

    <?php elseif (!empty($_GET['questionid']) && in_array($_GET['questionid'], $tm_qtids)):
        $tm_intid = (int)$_GET['questionid'];
        $tm_qtrow = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_questions where id = %d", $tm_intid));
        $tm_quizintid = $tm_qtrow->quiz_id;
        $tm_quizrow = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_quizzes where id = %d", $tm_quizintid));
        $wpdb->query($wpdb->prepare("select * from " . $wpdb->prefix . "tm_answers where question_id = %d", $tm_intid));
        $tm_anscount = $wpdb->num_rows; ?>

        <!--Изменить вопрос -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tabs-6" role="tab"
                   aria-controls="nav-home" aria-selected="true">Edit question</a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="tabs-6" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4>Edit question</h4><h4>
                    <a
                            href="<?php echo admin_url("admin.php?page=others&id=$tm_quizintid"); ?>">← Back to test
                        "<?php echo $tm_quizrow->name; ?>"</a></h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_question_update">
                    <input type="hidden" name="questionid" value="<?php echo $_GET['questionid']; ?>">
                    <input type="hidden" name="quizid" value="<?php echo $tm_qtrow->quiz_id; ?>">
                    <input type="hidden" name="order" value="<?php echo $tm_qtrow->order; ?>">

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Question</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="text" id="text" cols="65" rows="5"
                                      required><?php echo $tm_qtrow->text; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Correct message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="rightmsg" id="rightmsg" placeholder="Message"
                                   value="<?php echo $tm_qtrow->right_message; ?>">
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Incorrect message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="wrongmsg" id="wrongmsg" placeholder="Message"
                                   value="<?php echo $tm_qtrow->wrong_message; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="points" class="col-sm-2 col-form-label">Points</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="points" id="points" min="0"
                                   value="<?php echo $tm_qtrow->points; ?>">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="anstype" class="col-sm-2 col-form-label">Answer type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="anstype" id="anstype">
                                <option value="single" selected>Sigle choice</option>
                                <option value="multiple">Multiple choice</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" hidden>
                        <label for="ansrand" class="col-sm-2">Random order</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="ansrand" id="ansrand"
                                       type="checkbox" <?php if ($tm_qtrow->answer_random == 1) {
                                    echo "checked";
                                } ?>>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="answers" class="col-sm-2">Answers</label>
                        <div class="col-sm-8">
                            <div class="answers " id="answers">
                                <?php for ($i = 1; $i < $tm_anscount + 1; $i++) {
                                    $tm_answer = $wpdb->get_var($wpdb->prepare("select text from " . $wpdb->prefix .
                                        "tm_answers where `order` = %d and question_id = %d", $i, $tm_intid));
                                    $tm_right = $wpdb->get_var($wpdb->prepare("select `right_wrong` from " . $wpdb->prefix . "tm_answers where `order` = %d and question_id = %d", $i, $tm_intid));
                                    echo "<p><label class='answer col-sm-2' for='answer$i'>Answer $i</label><input name='answer$i' id='answer$i' class='answer' value='$tm_answer' size='78'><button class='delete button'><span class='ui-icon ui-icon-trash'></span></button><button class='addanswer button'><span class='ui-icon ui-icon-plus'></span></button>";
                                    if ($tm_qtrow->answer_type == 'single') {
                                        echo "<input type='radio' class='rw' id='rw$i' name='rw' value='answer$i'";
                                        if ($tm_right == 1) {
                                            echo "checked";
                                        }
                                        echo "></p>";
                                    } else {
                                        echo "<input type='checkbox' class='rw' id='rw$i' name='rw[]' value='answer$i'";
                                        if ($tm_right == 1) {
                                            echo "checked";
                                        }
                                        echo "></p>";
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>


                    <p><input type="submit" class="btn btn-primary" name="addquestion" id="addquestion"
                              value="Update"></p>
                </form>
                <div id="dialog2" style="display:none;">Please enter question text!</div>
                <div id="dialog3" style="display:none;">Please fill all answers!</div>
                <div id="dialog4" style="display:none;">Please select correct answer(s)!</div>
            </div>
        </div>
    <?php
    else: $tm_intid = (int)$_GET['id'];
        $tm_row = $wpdb->get_row($wpdb->prepare("select * from " . $wpdb->prefix . "tm_quizzes where id = %d", $tm_intid)); ?>
        <!--Внутри теста -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tabs-3" role="tab"
                   aria-controls="nav-home" aria-selected="true">Show questions</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#tabs-4" role="tab"
                   aria-controls="nav-profile" aria-selected="false">Add a question</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tabs-5" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Edit test</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tabs-9" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Results</a>

            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="tabs-3" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4><?php echo $tm_row->name; ?></h4><h4><a href="<?php echo admin_url('admin.php?page=others'); ?>">←
                        Back to test list</a></h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_question_delete">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Question</th>
                            <th scope="col">Points</th>
                        </tr>
                        </thead>
                        <!-- Список вопросов в тесте -->
                        <?php
                        $tm_questions = $wpdb->get_results($wpdb->prepare("select * from " . $wpdb->prefix .
                            "tm_questions where quiz_id = %d order by `order`", $tm_intid));
                        foreach ($tm_questions as $qlqt): ?>
                            <tr>
                                <td scope="row"><input type="checkbox" name="del<?php echo $qlqt->id; ?>"
                                                       id="del<?php echo $qlqt->id; ?>"
                                                       value="<?php echo $qlqt->id; ?>">
                                </td>
                                <td>
                                    <a href="<?php echo admin_url("admin.php?page=" . $_GET["page"]) . "&questionid=" . $qlqt->id; ?>"><?php echo strlen($qlqt->text) > 35 ? substr($qlqt->text, 0, 35) . "..." : $qlqt->text; ?></a>
                                </td>
                                <td><?php echo $qlqt->points; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"
                            name="delete">
                        Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete question?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Opravdu chcete smazat?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Smazat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="tabs-4" role="tabpanel" aria-labelledby="nav-profile-tab">
                <h4>Add a question</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_question_insert">
                    <input type="hidden" name="quizid" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="order" value="">


                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Question</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="text" id="text" cols="65" rows="2" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Correct message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="rightmsg" id="rightmsg" placeholder="Message">
                        </div>
                    </div>

                    <div class="form-group row" type="hidden">
                        <label for="rightmsg" class="col-sm-2 col-form-label">Incorrect message</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="wrongmsg" id="wrongmsg" placeholder="Message">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="points" class="col-sm-2 col-form-label">Points</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="points" id="points" min="0" value="1">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="anstype" class="col-sm-2 col-form-label">Answer type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="anstype" id="anstype">
                                <option value="single" selected>Sigle choice</option>
                                <option value="multiple">Multiple choice</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" hidden>
                        <label for="ansrand" class="col-sm-2">Random order</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="ansrand" id="ansrand" type="checkbox">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="answers" class="col-sm-2">Answers</label>
                        <div class="col-sm-8">
                            <div class="answers" id="answers">
                                <?php for ($i = 1; $i < 5; $i++) {
                                    echo "<p><label class='answer col-sm-2' for='answer$i'>Answer $i</label>
                        <input  placeholder='Right answer ' name='answer$i' id='answer$i' class='answer' size='78'><button class='delete button'><span class='ui-icon ui-icon-trash'></span></button><button class='addanswer button'><span class='ui-icon ui-icon-plus'></span></button><input type='radio' class='rw' id='rw$i' name='rw' value='answer$i'></p>";
                                } ?>
                            </div>
                        </div>
                    </div>


                    <p><input type="submit" class="btn btn-primary" name="addquestion" id="addquestion"
                              value="Add"></p>
                </form>
                <div id="dialog2" style="display:none;">Please enter question text!</div>
                <div id="dialog3" style="display:none;">Please fill all answers!</div>
                <div id="dialog4" style="display:none;">Please select correct answer(s)!</div>
            </div>
            <div class="tab-pane fade" id="tabs-5" role="tabpanel" aria-labelledby="nav-contact-tab">
                <h4>Edit test</h4>
                <form action="<?php echo admin_url('admin.php'); ?>" method="post">
                    <input type="hidden" name="action" value="tm_update">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="title" id="title" value="<?php echo $tm_row->name; ?>"
                                   placeholder="Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="description" id="description" cols="65"
                                      rows="2"><?php echo $tm_row->description; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="typetest" id="typetest">
                                <option value="students" <?php if (($tm_row->typ_test) == "students") echo "selected"; ?>>
                                    Students
                                </option>
                                <option value="teachers" <?php if (($tm_row->typ_test) == "teachers") echo "selected"; ?>>
                                    Teachers
                                </option>
                                <option value="firms" <?php if (($tm_row->typ_test) == "firms") echo "selected"; ?>>
                                    Firms
                                </option>
                                <option value="others" <?php if (($tm_row->typ_test) == "others") echo "selected"; ?>>
                                    Others
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="numbtype" class="col-sm-2 col-form-label">Numbering type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="numbtype" id="numbtype">
                                <option value="numerical" <?php if (($tm_row->numbering_type) == "numerical") echo "selected"; ?>>
                                    Numerical
                                </option>
                                <option value="alphabetical" <?php if (($tm_row->numbering_type) == "alphabetical") echo "selected"; ?>>
                                    Alphabetical
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="showtype" class="col-sm-2 col-form-label">Show type</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="showtype" id="showtype">
                                <option value="paginated" <?php if (($tm_row->show_type) == "paginated") echo "selected"; ?>>
                                    Each question on its own page
                                </option>
                                <option value="allonone" <?php if (($tm_row->show_type) == "allonone") echo "selected"; ?>>
                                    All questions on one page
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rightcolor" class="col-sm-2 col-form-label">Rigth color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="rightcolor" id="rightcolor"
                                   value="<?php echo substr($tm_row->right_color, 1); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="wrongcolor" class="col-sm-2 col-form-label">Wrong color</label>
                        <div class="col-sm-8">
                            <input class="color form-control" name="wrongcolor" id="wrongcolor"
                                   value="<?php echo substr($tm_row->wrong_color, 1); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">Skip questions</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="skip" type="checkbox" id="skip"
                                    <?php if ($tm_row->skip == 1) echo "checked"; ?>>
                            </div>
                        </div>
                    </div>

                    <p><input type="submit" class="btn btn-primary" name="addquiz" id="addquiz"
                              value="Update"></p>
                </form>
                <div id="dialog" style="display:none;">Please write test name</div>
            </div>
            <div class="tab-pane fade" id="tabs-9" role="tabpanel" aria-labelledby="nav-contact-tab">
                <h4><?php echo $tm_row->name; ?></h4><h4><a href="<?php echo admin_url('admin.php?page=others'); ?>">←
                        Back to test list</a></h4>

                <?php
                $tm_results = $wpdb->get_results($wpdb->prepare("select * from " . $wpdb->prefix .
                    "tm_result_final where quiz_id = %d ORDER by id", $tm_intid));

                $dataPoints = array();

                foreach ($tm_results as $qlr) {
                    array_push($dataPoints, array("y" => $qlr->points));
                }
                ?>

                <script>
                    window.onload = function () {

                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            labelMaxWidth: 100,
                            theme: "light",
                            title: {
                                text: "Tests"
                            },
                            axisX: {},
                            axisY: {
                                title: "Results of tests",
                                maximum: 100
                            },
                            data: [{
                                type: "area",
                                xValueFormatString: "#,## test ",
                                yValueFormatString: "#,##0.## percent",
                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        chart.render();

                    }
                </script>

                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>


        </div>


    <?php endif;
    echo ob_get_clean();
}

?>


