<?php
include_once 'autoloader.php';

use Lib\GeneratePassword as GeneratePassword;
use Lib\Constants as Constants;

$generator = new GeneratePassword();
$randomPassword = $generator->generate();
$post = array();

if (!empty($_POST)) {
    $post = $_POST;
    $generator->setCharacters($post['characters']);
    $generator->setLength($post['length']);
    $generator->setCount($post['count']);
    $customPasswords = $generator->generate();
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Password generator</title>
        <link href="css/style.css" rel="stylesheet">
        <script src="js/script.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <h1>Password generator</h1>
            <form action="/" method="post" id="form">                
                <div id="section">  
                    <div class="row">
                        <div class="column">Password length:</div>
                        <div class="column">
                            <label>
                                <input name="length" id="length" type="number" 
                                       min="<?php echo Constants::MIN_LENGTH; ?>" 
                                       max="<?php echo Constants::MAX_LENGTH; ?>" 
                                       value="<?php echo!empty($post['length']) ? $post['length'] : Constants::DEFAULT_LENGTH; ?>"
                                       />
                            </label>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="column">Password count:</div>
                        <div class="column">
                            <label>
                                <input name="count" id="count" type="number" 
                                       min="<?php echo Constants::MIN_COUNT; ?>" 
                                       max="<?php echo Constants::MAX_COUNT; ?>" 
                                       value="<?php echo!empty($post['count']) ? $post['count'] : Constants::DEFAULT_COUNT; ?>"
                                       />
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column">Include numbers:</div>
                        <div class="column">
                            <label>
                                <input name="characters[]" id="numbers" type="checkbox" 
                                       value="<?php echo Constants::NUMBERS; ?>"
                                       <?php if ((isset($post['characters']) && in_array(Constants::NUMBERS, $post['characters'])) || empty($post)) { ?> checked <?php } ?>
                                       /> ( e.g. 123456 )
                            </label>
                        </div>	
                    </div>

                    <div class="row">
                        <div class="column">Include lowercase characters:</div>
                        <div class="column">
                            <label>
                                <input name="characters[]" id="lowercase" type="checkbox" 
                                       value="<?php echo Constants::LOWERCASE; ?>"
                                       <?php if ((isset($post['characters']) && in_array(Constants::LOWERCASE, $post['characters'])) || empty($post)) { ?> checked <?php } ?>
                                       /> ( e.g. abcdefgh )
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column">Include uppercase characters:</div>
                        <div class="column">
                            <label>
                                <input name="characters[]" id="uppercase" type="checkbox" 
                                       value="<?php echo Constants::UPPERCASE; ?>"
                                       <?php if ((isset($post['characters']) && in_array(Constants::UPPERCASE, $post['characters'])) || empty($post)) { ?> checked <?php } ?>
                                       /> ( e.g. ABCDEFGH )
                            </label>
                        </div>	
                    </div>

                    <div class="row">
                        <div class="column">Exclude ambiguous characters:</div>
                        <div class="column">
                            <label>
                                <input name="characters[]" id="specialsymbols" type="checkbox"
                                       value="<?php echo Constants::SPECIALSYMBOLS; ?>"
                                       <?php if (isset($post['characters']) && in_array(Constants::SPECIALSYMBOLS, $post['characters'])) { ?> checked <?php } ?>
                                       /> ( e.g. { } [ ] ( ) $ # @ % ; )
                            </label>
                        </div>	
                    </div>
                </div>

                <div id="section">
                    <div class="button custom_button" onclick="submit();">Generate</div>
                </div>

                <div id="section" style="margin-top: 40px;">
                    <b>Fast custom password:</b> <br/> 
                    <xmp><?php echo $randomPassword[0]; ?></xmp>
                </div>

                <?php if (!empty($customPasswords)) { ?>
                    <div id="section">
                        <b>Generated passwords:</b> <br/>
                            <?php
                            foreach ($customPasswords as $password) {
                                echo '<xmp>' . $password . '</xmp>';
                            }
                            ?>
                    </div>
                <?php } ?>
            </form>

        </div>
    </body>
</html>