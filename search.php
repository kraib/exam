<?php

$qk = array("lazy" => 2,
    "fox" => 1,
    "brown" => 1);
$sa = "The quick brown lazy fox jumps over the lazy dog.";
$qk_new = array("Living" => 2,
    "Non-Living" => 2,
    "Study" => 1);
$answer_new ='Study of living things and nonliving things.';
echo grade_question($qk_new, $answer_new);


function grade_question($question_keywords, $student_answer)
{

    $score = 0;
    foreach($question_keywords as $keyw => $mark){

        if(preg_match("/(".$keyw.")/i", $student_answer, $match)){
            $score+=$mark;
        }

    }
    return $score;
}

?>
