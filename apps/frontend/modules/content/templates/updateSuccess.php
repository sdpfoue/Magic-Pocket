<?php echo
 $test_object->testSpecialChars('&') ?>

// The three following lines return the same value
<?php echo $test_object->testSpecialChars('&', ESC_RAW) ?>
<?php echo $sf_data->getRaw('test_object')->testSpecialChars('&') ?>
<?php echo $sf_data->get('test_object', ESC_RAW)->testSpecialChars('&') ?>
