<?php

class __Cfg
{
    private $argument;
    private $name;
    private String $path_hell = "/Src/Hell/__load__.php";
    private Array $default_configurations = array(
        'PORT' => 80,
        'HOSTS' => ['warframe'],
        'SECURITY' => array(
            'GUARD' => false,
            'SERIAL' => null,
        ),
        'GLOBAL_SETTING' => array(
            'TIME_ZONE' => 'Asia/Samarkand',
            'SESSION_TIMEOUT' => null,
            'SESSION_LIFE' => null,
            'HIDE_EXTENSION' => false,
            'DEBUG' => true,
        ),
        'DATABASE' => array(
            'DRIVER' => 'mysql',
            'CHARSET' => 'utf8',
            'HOST' => 'localhost',
            'PORT' => 3306,
            'NAME' => null,
            'USER' => null,
            'PASS' => null,
        )
    );

    function __construct($value = null, $name = null)
    {
        $this->argument = $value;
        $this->name = $name;
        $this->handle();
    }

    public function handle()
    {
        if (!is_null($this->argument)) $this->resolution();
        else $this->help();
    }

    private function resolution()
    {
        if ($this->argument == "init") $this->init();
        elseif ($this->argument == "gen") $this->generate();
        elseif ($this->argument == "edit") $this->edit();
        elseif ($this->argument == "show") $this->show();
        else echo "\033[31m"." Не такого аргумента.\n";
    }

    private function init()
    {
        require dirname(__DIR__, 2) . $this->path_hell;
        
        if (!file_exists(CFG_PATH_CLOSE)) {
            $fp = fopen(CFG_PATH_OPEN, "x");
            fwrite($fp, Hell::array_to_ini($this->default_configurations));
            echo "\033[32m". " " . basename(CFG_PATH_OPEN) . " сгенирирован успешно!\n";
            fclose($fp);
        }else{
            echo "\033[33m". " " . basename(CFG_PATH_CLOSE) . " уже существует!\n";
        }
    }

    private function generate()
    {
        if (file_exists(CFG_PATH_OPEN)) {
            $sett = parse_ini_file(CFG_PATH_OPEN, true);
            if (!file_exists(CFG_PATH_CLOSE)) {
                $fp = fopen(CFG_PATH_CLOSE, "x");
                fwrite($fp, chunk_split( bin2hex(zlib_encode(json_encode($sett), ZLIB_ENCODING_DEFLATE)) , 50, "\n") );
                fclose($fp);
                if (unlink(CFG_PATH_OPEN)) {
                    echo "\033[32m". " " . basename(CFG_PATH_CLOSE) . " сгенирирован успешно!\n";
                }else {
                    unlink(CFG_PATH_CLOSE);
                    echo "\033[31m"."Ошибка при генерации.\n";
                }
            }else{
                echo "\033[33m". " " . basename(CFG_PATH_CLOSE) . " уже существует!\n";
            }
        }else {
            echo "\033[33m". " " . basename(CFG_PATH_OPEN) . " не найден!\n";
        }
    }

    private function edit()
    {
        require dirname(__DIR__, 2) . $this->path_hell;
        
        if (file_exists(CFG_PATH_CLOSE)) {
            $fp = fopen(CFG_PATH_OPEN, "x");
            fwrite($fp, Hell::array_to_ini(cfgGet()));
            fclose($fp);
            unlink(CFG_PATH_CLOSE);
            echo "\033[32m". " " . basename(CFG_PATH_OPEN) . " сгенирирован успешно!\n";
        }else{
            echo "\033[33m". " " . basename(CFG_PATH_CLOSE) . " не существует!\n";
        }
    }

    private function show()
    {
        require dirname(__DIR__, 2) . $this->path_hell;

        if (file_exists(CFG_PATH_CLOSE)) {
            print_r(Hell::array_to_ini(cfgGet()));
        }else{
            echo "\033[33m". " " . basename(CFG_PATH_CLOSE) . " не существует!\n";
        }
    }

    private function help()
    {
        echo "\033[33m"." =======> Help <======= \n";
        echo "\033[33m"."  :init     -  создать файл настроек.\n";
        echo "\033[33m"."  :gen      -  сгенерировать конфигурации.\n";
        echo "\033[33m"."  :edit     -  изменить настройки.\n";
        echo "\033[33m"."  :show     -  просмотр настроек.\n";
        echo "\033[33m"." =======> Help <======= \n";
    }

}

?>