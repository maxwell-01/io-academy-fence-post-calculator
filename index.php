<?php
function fenceLength($posts, $railings) {
  // $posts = intval($posts);
  // $railings = intval($railings);
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
  //returns array = [posts, railings]
  // $length = intval($length);
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

echo fenceLength(92,91);
echo "\n";
print_r(required_fence_equipment(145.7));
echo "\n";

/*




1 length of fence is 2 posts, 1 railing

each additional lenth of fence is 1 more railing and 1 more post

post = 0.1m wide
railing = 1.5m wide

therefore one length = 1.7m
each additional length = 1.6m more

so number of posts must always be 1 more than number of railings

so minus off 2 posts and 1 railing, then the remaining length is the smaller of the two remaining numbers x 1.6


if posts >= 2 AND railings >= 1 then we have a length
check this first
else return "not enough materials to make a fence"

if posts == 2 AND railings == 1 then length is 1.7m

else
remaining posts = posts - 2
remaining railings = railings -1
(add numbers to an array) use min to find smallest number
remaining length = smallest number x 1.6

total length = initial length + remianing length

if length less than 1.7m than 0
if 1.7m than 2 posts and 1 railing
for each extra 1.6m its an extra railing and and an extra post
therefore its the remaining length /1.6, rounded down number of railings and posts

*/

?>