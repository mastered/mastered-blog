<div class="theme">
                                <span class="header"><input contenteditable="true" size="60" type="text" name="s-header" id="s-header" value="<?php echo $settings['header'] ?>">
                                <ul class="list">
                                    <li class="one"><input contenteditable="true" size="30" type="text" name="s-list1" id="s-list1" value="<?php echo $settings['list_items'][0] ?>">
                                    </li><li class="two"><input type="text" contenteditable="true" size="30" name="s-list2" id="s-list2" value="<?php echo $settings['list_items'][1] ?>"></li>
                                    <li class="three"><input type="text" contenteditable="true" size="30" name="s-list3" id="s-list3" value="<?php echo $settings['list_items'][2] ?>"></li>
                                </ul>
                                <span class="sub-header">
                                <input type="text" name="s-subheader" contenteditable="true" size="50" id="s-subheader" value="<?php echo $settings['sub_header'] ?>">
                                </span>
                                <div id="subscriber-form">
                                    <p><input type="text" name="first_name_text" size="40" placeholder="<?php echo $settings['first_name_text'] ?>"></p>
                                    <p><input type="text" name="enter_email_text" size="40" placeholder="<?php echo $settings['enter_email_text'] ?>"></p>
                                    <p><span class="sbutton sorange subbutton"><input type="text" name="s-btntxt" id="s-btntxt" value="<?php echo $settings['button_txt'] ?>"></span></p>
                                </div>
                            </span></div>
<input type="hidden" value="yes" name="default_theme_is_theme" />
<style type="text/css">
    .ui .section{
        border:3px solid red;
        margin:5px;
        padding:5px;
        display:none;
    }
    .ui .section h4{
        font-size:18px;
        display:inline;
        padding-right:10px;
    }

    .theme{
        width:500px;
        background-color:white;
        margin:auto;
        text-align:center;
        padding:10px;
    }
    .theme .header{
        font-size:16px;
    }
    .theme .sub-header{
        font-size:14px;
    }

</style>


<style>
  
    .sbutton {
    display: inline-block;
    outline: none;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    font: 15px/100% Arial, Helvetica, sans-serif;
    padding: .5em 2em .55em;
    text-shadow: 0 1px 1px rgba(0,0,0,.3);
    -webkit-border-radius: .5em; 
    -moz-border-radius: .5em;
    border-radius: .5em;
    -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
    -moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
    box-shadow: 0 1px 2px rgba(0,0,0,.2);
}
.sbutton:hover {
    text-decoration: none;
}
.sbutton:active {
    position: relative;
    top: 1px;
}
.sorange {
    color: #fef4e9;
    border: solid 1px #da7c0c;
    background: #f78d1d;
    background: -webkit-gradient(linear, left top, left bottom, from(#faa51a), to(#f47a20));
    background: -moz-linear-gradient(top,  #faa51a,  #f47a20);
    filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#faa51a', endColorstr='#f47a20');
}
.sorange:hover {
    background: #f47c20;
    background: -webkit-gradient(linear, left top, left bottom, from(#f88e11), to(#f06015));
    background: -moz-linear-gradient(top,  #f88e11,  #f06015);
    filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#f88e11', endColorstr='#f06015');
}
.sorange:active {
    color: #fcd3a5;
    background: -webkit-gradient(linear, left top, left bottom, from(#f47a20), to(#faa51a));
    background: -moz-linear-gradient(top,  #f47a20,  #faa51a);
    filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#f47a20', endColorstr='#faa51a');
}

.wpp_default_theme_cont {
	
}

  </style>