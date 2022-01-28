<?php

namespace App\Service;


class RepositoryService {

    protected static function getStubs($type)
    {
        return file_get_contents(resource_path("command-template/$type.stub"));
    }

    public static function ImplementNow($name)
    {
        if (!file_exists($path=base_path('/app/Repository')))
            mkdir($path, 0777, true);
        self::MakeRepositoryClass($name);
        self::MakeRepositoryInterface($name);
    }

    protected static function MakeRepositoryClass($name)
    {
        $template = str_replace(
            ['{{name}}'],
            [$name],
            self::GetStubs('Repository')
        );

        file_put_contents(base_path("app/Repository/Eloquent/{$name}Repository.php"), $template);

    }
    protected static function MakeRepositoryInterface($name)
    {
        $template = str_replace(
            ['{{name}}'],
            [$name],
            self::GetStubs('RepositoryInterface')
        );

        file_put_contents(base_path("app/Repository/{$name}RepositoryInterface.php"), $template);

    }
}
