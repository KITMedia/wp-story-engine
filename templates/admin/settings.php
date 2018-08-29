<div class="wrap">
    <h2>
        <?php echo $headline; ?>
    </h2>
    <p>
        <?php echo $body; ?>
    </p>

    <hr/>

    <h3>Endpoints</h3>

    <p>
        Post Endpoint: <code><?php echo $apiUrl; ?></code>
    </p>
    <p>
        Delete Endpoint: <code><?php echo $apiUrl; ?>/{Story-Engine-ID}</code>
    </p>

    <p>
        <a href="<?php echo $regenerateTokenUrl; ?>"
           class="button-primary"
           title="Regenerate Access Token">
            Regenerate Access Token
        </a>
    </p>

    <hr/>

    <h3>Settings</h3>

    <form action="?page=wp-story-engine-settings" method="post">

        <p>
            <label for="debugMode">
                <input type="checkbox" value="1" name="debug" <?php echo $debug ? 'checked="checked"' : ''; ?> />
                Debug Mode (adds post and result data to response and post)
            </label>
        </p>

        <p>
            <label for="noExcerpt">
                <input type="checkbox" value="1" name="noExcerpt" <?php echo $excerpt ? 'checked="checked"' : ''; ?> />
                Skip excerpt in post_body (excerpt will only be imported to post_excerpt)
            </label>
        </p>

        <p>
            <label for="importToCategory">
                <input type="checkbox" value="1"
                       name="importToCategory" <?php echo $importToCategory ? 'checked="checked"' : ''; ?> />
                Import posts to an already existing category:
            </label>

            <select name="importToCategoryId" id="importToCategoryId">
                <option>Select category...</option>
                <?php foreach (get_categories(array('hide_empty' => false)) as $category): ?>
                    <option value="<?php echo $category->term_id ?>"
                        <?php echo (int)$importToCategoryId == $category->term_id ? ' selected="selected"' : '' ?>>
                        <?php echo $category->name ?>
                    </option>
                    <?php print_r($category) ?>
                <?php endforeach; ?>
            </select>

        </p>

        <input name="save" type="submit" class="button-primary" value="Save"/>

    </form>

</div>
