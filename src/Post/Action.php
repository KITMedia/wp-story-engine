<?php

namespace StoryEngine\WebHook\Post;

class Action
{

    public static function receive(\WP_REST_Request $request)
    {

        return [
            'result' => 'success',
            'data' => $request->get_params(),
        ];

        /*
        $burger = (new BurgerBuilder(14))
            ->addPepperoni()
            ->addLettuce()
            ->addTomato()
            ->build();
        */


    }
}
