<?php

$scale_one = filter_input(INPUT_POST, 'scale_one');
$scale_two = filter_input(INPUT_POST, 'scale_two');
$amt_visit = filter_input(INPUT_POST, 'amt_visit');
$first_hear = filter_input(INPUT_POST, 'first_hear');
$other_method = filter_input(INPUT_POST, 'other_method');
$suggestion = filter_input(INPUT_POST, 'suggestion');
$action = filter_input(INPUT_POST, 'action');
$error = "";

if ($action == "send_results") {
    if ($scale_one == NULL || $scale_two == NULL || $amt_visit == NULL || $first_hear == NULL) {
        $error = "Please fill out all the questions in the survey.";
        echo $error;
    } else if ($first_hear == "other" && ($other_method == "" || $other_method == NULL)) {
        $error = "You must fill out what other method you used because you clicked other when you chose how your heard of my site.";
        echo $error;
    } else {
        $_SESSION['survey_check']['answer'] = 'yes';
        //open file and allow reading and writing at end of file
        $scale_one_array = fopen("scale_one_array.txt", "a+") or die("Unable to open file");

        //write $scale_one at the end of the file.
        fwrite($scale_one_array, $scale_one);

        //set reading cursor at beginning of file
        fseek($scale_one_array, $whence = SEEK_SET);

        $count = 0;
        $str = file_get_contents("scale_one_array.txt");
        $add_scale_one = 0;

        $scale_one_exp = explode("<br>", $str);
        foreach ($scale_one_exp as $value) {
            $count++;
            $add_scale_one += $value . " " . "<br>";

            //echo $value . "<br>";
        }

        $avg_scale_one = $add_scale_one / $count;
        echo "The percentage of votes towards how much this site was enjoyed: " . $avg_scale_one . "<br>";

        fclose($scale_one_array);



        //open file and allow reading and writing at end of file
        $scale_two_array = fopen("scale_two_array.txt", "a+") or die("Unable to open file");

        //write $scale_one at the end of the file.
        fwrite($scale_two_array, $scale_two);

        //set reading cursor at beginning of file
        fseek($scale_two_array, $whence = SEEK_SET);

        $count = 0;
        $str = file_get_contents("scale_two_array.txt");
        $add_scale_two = 0;

        $scale_two_exp = explode("<br>", $str);
        foreach ($scale_two_exp as $value) {
            $count++;
            $add_scale_two += $value . " " . "<br>";

            //echo $value . "<br>";
        }

        $avg_scale_two = $add_scale_one / $count;
        echo "The percentage of votes towards how much this site was frustrating: " . $avg_scale_two;

        fclose($scale_two_array);

        echo "<br> You visit: " . $amt_visit . ". <br>";

        echo "You heard about meghanshannon.com via " . $first_hear . ". <br>";

        echo "Thank you for sharing your suggestions!";
    }
} else {
    echo "The results so far: <br>";
    $scale_one_array = fopen("scale_one_array.txt", "r") or die("Unable to open file");

    $count = 0;
    $str = file_get_contents("scale_one_array.txt");
    $add_scale_one = 0;

    $scale_one_exp = explode("<br>", $str);
    foreach ($scale_one_exp as $value) {
        $count++;
        $add_scale_one += $value . " " . "<br>";

        //echo $value . "<br>";
    }

    $avg_scale_one = $add_scale_one / $count;
    echo "The percentage of votes towards how much this site was enjoyed: " . $avg_scale_one . "<br>";

    fclose($scale_one_array);



    //open file and allow reading and writing at end of file
    $scale_two_array = fopen("scale_two_array.txt", "r") or die("Unable to open file");

    $count = 0;
    $str = file_get_contents("scale_two_array.txt");
    $add_scale_two = 0;

    $scale_two_exp = explode("<br>", $str);
    foreach ($scale_two_exp as $value) {
        $count++;
        $add_scale_two += $value . " " . "<br>";

        //echo $value . "<br>";
    }

    $avg_scale_two = $add_scale_one / $count;
    echo "The percentage of votes towards how much this site was frustrating: " . $avg_scale_two;
}




