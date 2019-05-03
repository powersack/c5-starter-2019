<div id="verignSnippets">
    <h1>Textbausteine</h1>
    <div id="verignSnippetsFormWrapper">


        <form action="<?= $this->action('') ?>" method="post" class="verignSnippetsForm">
<!--            <span>add/edit a snippet:</span>-->
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" />
            </div>

            <?php foreach ($languages as $val => $lang){ ?>
                <div>
                    <label><?= $lang ?></label>
                    <textarea name="snippets[<?= $val ?>]" data-lang="<?= $val ?>"></textarea>
                </div>
            <?php } ?>
            <div>
                <input type="submit" name="submit" value="speichern" />
            </div>
        </form>
    </div>


    <table id="snippetList">
        <thead>
        <tr>
            <th>
                Name
            </th>
            <?php foreach ($languages as $val => $lang){ ?>
                <th>
                    <?= $lang ?>
                </th>
            <?php } ?>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($snippets as $name => $snippet){ ?>
            <tr>
                <td data-type="name"><?= $name ?></td>
                <?php foreach ($languages as $val => $lang){
                    if($val){ ?>
                        <td data-type="snippet" data-lang="<?= $val ?>"><?php if($snippet[$val] ) { ?><?= nl2br(htmlentities($snippet[$val])) ?><?php } ?></td>
                    <?php } ?>
                <?php } ?>
                <td>
                    <a href="#" class="editSnippet">
                        <i class="fa fa-edit"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>