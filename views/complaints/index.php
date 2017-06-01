<html>
    <head>
        <meta http-equiv="content-type" content="text/html: charset=utf-8" />
        <link href="templates/style.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--        <script src="templates/main.js"></script>-->
        
    </head>
    <body>
        <div>            
            <form method='post'action="admin">
            <input type="text" name="login" placeholder="login" />
            <input type="password" name="pass" placeholder="pass" />
            <input type="submit" value="Submit" />
            </form>            
        </div>
        <div>            
            <span class="logout">log out</span>
        </div>
        <br>
        <br>
        <div id="pagination"></div>
        <div id="pagination_num">
            <?php 
                for($i=1;$i<=$pages;$i++){ ?>
            <div  class="pagination" id="<?php echo $i; ?>"><span><?php echo $i;?></span></div><?php
                }
            ?>
        </div>
        
        
        
        <div class="form-style-6">            
            <form id="idform" method='post'>
            <input type="text" name="name" placeholder="Your Name" />
            <input type="email" name="email" placeholder="Email Address" />
            <input type="text" name="site" placeholder="Your Site" />
            <img src="./templates/images/captcha.jpg">
            <input type="text" name="captcha" placeholder="captcha" />
            <textarea rows="5" cols="20" name="text"></textarea>
            <input type="submit" value="Submit" />
            </form>
            <div id="some"></div>
        </div>
        <div class="form-update">            
            <form id="updateform" method='post'>
            <input id="update" type="hidden" name="id"  />
            <input type="text" name="name" placeholder="Your Name" />
            <input type="email" name="email" placeholder="Email Address" />
            <textarea rows="5" cols="20" name="text"></textarea>
            <input type="submit" value="Submit" />
            </form>
            <div id="some"></div>
        </div>

    </body>
</html>
      <script src="templates/main.js"></script>