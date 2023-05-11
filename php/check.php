
<?php

$text = 'There are many ways to earn money online, and the best option for you will depend on your skills, interests, and availability. Here are a few options you could consider:

    Freelancing: You could offer your skills and expertise in areas like writing, graphic design, programming, or digital marketing on freelancing platforms like Upwork, Fiverr, or Freelancer. These platforms allow you to connect with clients and earn money for the work you complete.
    
    Online tutoring: If you have expertise in a particular subject, you could offer your services as an online tutor. There are many platforms like Chegg, TutorMe, and Skooli that allow you to connect with students who need help in specific subjects.
    
    Affiliate marketing: You could earn money by promoting products or services on your website, blog, or social media accounts. You would receive a commission for every sale or conversion that comes through your affiliate link.
    
    Online surveys: You could earn mo';


echo strlen($text);





?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test upload image by jquery</title>
</head>
<body>
    
<p class="status">


    <?php
    
    if(strlen($text) > 200){
        echo substr("$text",0,400)."..."."<span>Read</span>";
    }else{
        echo $text;
    }
    
    ?>


</p>

</body>
<script src="../javascript/jquery-3.6.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){


});
</script>
</html>