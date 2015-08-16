<?php

$qk = array("lazy" => 2,
		"fox" => 1,
		"brown" => 1 );
$sa = "The quick brown lazy fox jumps over the lazy dog.";
echo grade_question($qk, $sa);


function grade_question($question_keywords, $student_answer){
$keywords = array_keys($question_keywords);

$pattern = implode("|", $keywords);

preg_match_all("/($pattern)/i",$student_answer, $match);

$words = array_unique($match[0]);
//var_dump($words);
$score=0;
foreach ($words as $word)
{
 if(isset($question_keywords[$word]))
 {
   $score+=$question_keywords[$word];
 }
}
return $score;
}
?>
