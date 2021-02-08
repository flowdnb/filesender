    <?php
    
    $sections = array('transfers', 'guests', 'users', 'testing' );
    
    if(Config::get('config_overrides'))
        $sections[] = 'config';
    
    $section = 'transfers';
    if(array_key_exists('as', $_REQUEST)) {
        if( strlen($_REQUEST['as'])) {
            $section = $_REQUEST['as'];
        }
    }

    if(!in_array($section, $sections)) throw new GUIUnknownAdminSectionException($section);
    
    ?>

    <ul class="nav nav-tabs nav-tabs-coretop">
        <?php foreach($sections as $s) { ?>
            <li class="nav-item">
                <a class="nav-link <?php if($s == $section) echo 'active'; else echo 'nav-link-coretop ' ?>" href="?s=admin&as=<?php echo $s ?>">
                    <?php echo Lang::tr('admin_'.$s.'_section') ?>
                </a>
            </li>
        <?php } ?>
    </ul>
    
<div class="core">
    
    <div class="<?php echo $section ?>_section section">
        <?php Template::display('admin_'.$section.'_section') ?>
    </div>
</div>
