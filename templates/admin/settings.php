<div class="wrap">
    <h2>
        <?php echo $headline; ?>
    </h2>
    <p>
        <?php echo $body; ?>
    </p>

    <hr/>

    <h3>Endpoint</h3>

    <p>
        Post Endpoint: <code><?php echo $apiUrl; ?></code>
    </p>
    <p>
        <a href="<?php echo $regenerateUrl; ?>"
           class="button-primary"
           title="Regenerate Access Token">
            Regenerate Access Token
        </a>
    </p>

    <hr/>

    <h3>Settings</h3>

    <form>

        <p>
            <label for="debugMode">
                <input type="checkbox" value="1" name="debug"/>
                Debug Mode (adds post and result data to response and post)
            </label>
        </p>

        <input type="submit" class="button-primary" value="Save"/>

    </form>

</div>
