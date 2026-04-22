<?php 


function ui_card($title, $content) { ?>
    <div class="card">
        <?php if ($title): ?>
            <h2><?php echo $title; ?></h2>
        <?php endif; ?>
        <?php echo $content; ?>
    </div>
<?php } 


function ui_table($headers, $rows) { ?>
<table>
    <tr>
        <?php foreach ($headers as $h): ?>
            <th><?php echo $h; ?></th>
        <?php endforeach; ?>
    </tr>

    <?php foreach ($rows as $row): ?>
        <tr>
            <?php foreach ($row as $cell): ?>
                <td><?php echo $cell; ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
<?php } 

function ui_input($name, $value = '', $placeholder = '') { ?>
    <input type="text" name="<?php echo $name; ?>"
           value="<?php echo htmlspecialchars($value); ?>"
           placeholder="<?php echo $placeholder; ?>">
<?php } 


function ui_textarea($name, $value = '') { ?>
    <textarea name="<?php echo $name; ?>"><?php echo htmlspecialchars($value); ?></textarea>
<?php } 

function ui_button($label, $type = 'submit') { ?>
    <button type="<?php echo $type; ?>">
        <?php echo $label; ?>
    </button>
<?php }


?>