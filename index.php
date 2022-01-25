<?php

function fenceLength($posts, $railings) {
  if (($posts < 2) || ($railings < 1)) {
    return 0;
  }
    if (($posts == 2) || ($railings == 1)) {
      return 1.7;
    }
    $remaining_posts = $posts - 2;
    $remaining_railings = $railings - 1;

    $remaining_lengths = min($remaining_posts, $remaining_railings);

    $remaining_fence = 1.6 * $remaining_lengths;
    $total_fence_length = 1.7 + $remaining_fence;

    $rounded_total = number_format((float)$total_fence_length, 2, '.', '');
    return $rounded_total;
    
}

function required_fence_equipment($length){
  if ($length < 1.7) {
    return ["posts_required" => 0, "railings_required" => 0];
  }
  if ($length == 1.7) {
    return ["posts_required" => 2, "railings_required" => 1];
  }
  $remaining_length = $length - 1.7;
  $number_of_extra_sets = ceil($remaining_length / 1.6 );
  $posts_required = $number_of_extra_sets + 2;
  $railings_required = $number_of_extra_sets + 1;
  return ["posts_required" => $posts_required, "railings_required" => $railings_required];
}

if (isset($_POST["fence_length_input"])) {
    $returned_equipment = required_fence_equipment($_POST["fence_length_input"]);
    $posts_required = $returned_equipment["posts_required"];
    $railings_required = $returned_equipment["railings_required"];
}

if (isset($_POST["posts_available_input"])) {
    $returned_length = fenceLength($_POST["posts_available_input"], $_POST["railings_available_input"]);
}

?>

<!DOCTYPE html>
<html lang="en-GB">

<head>
    <title>Fence Post Challenge</title>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/jpg" href="favicon.ico"/>
</head>

<body>
<header>

    <h1>Fencing assistant</h1>
    <p>Not <i>that</i> kind of fencing</p>

</header>

<main>
    <section class="input-forms-section">
        <div class="input-forms-parent">
            <form method="post" action="#answer-section">
                <h2>Calculate required supplies</h2>
                <p>Instructions here</p>
                <div class="side-by-side-label-input">
                    <label for="fence_length_input">Fence length (m):</label>
                    <input type="number" id="fence_length_input" name="fence_length_input">
                </div>
                <input class="form-submit-button" type="submit" value="Calculate">
                <a href="index.php">Reset</a>
            </form>

            <form method="post" action="#answer-section">
                <h2>Calculate fence length</h2>
                <p>Instructions here</p>
                <div class="side-by-side-label-input">
                    <label for="posts_available_input">Posts available:</label>
                    <input type="number" id="posts_available_input" name="posts_available_input">
                </div>
                <div class="side-by-side-label-input">
                    <label for="railings_available_input">Railings available:</label>
                    <input type="number" id="railings_available_input" name="railings_available_input">
                </div>
                <input class="form-submit-button" type="submit" value="Calculate">
                <a href="index.php">Reset</a>
            </form>
        </div>
    </section>
    <section id="answer-section" class="answer-section">
        <p>
            <?php
            if (isset($_POST["fence_length_input"])) {
                echo "$_POST[fence_length_input]m of fence will require $posts_required posts and $railings_required railings.";
            }

            if (isset($_POST["posts_available_input"])) {
                echo "$_POST[posts_available_input] posts and $_POST[railings_available_input] railings can produce $returned_length"."m length of fencing.";
            }
            ?>
        </p>
    </section>
</main>

<footer>
    <div>
        <div class="footer-item">
            <a href="https://www.instagram.com/thehopefulhitchhikers/?hl=en" target="_blank">Instagram</a>
        </div>

        <div class="footer-item">
            <a href="https://www.linkedin.com/in/maxwellnewton/" target="_blank">LinkedIn</a>
        </div>

        <div class="footer-item">
            <a href="https://github.com/maxwell-01" target="_blank">GitHub</a>
        </div>
    </div>

</footer>

</body>

</html>
