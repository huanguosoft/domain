# domain
PHP根据url获取顶级域名

####加载

    composer require 'agile/domain:~1.0'

    或者在composer.json文件中添加
    "require": {
        "agile/domain": "~1.0"
    }

####使用
    use Agile\Lib\Domain\Domain;
    public function index(Domain $domain)
    {
        $host = $domain->getDomain('http://www.huanguosoft.com');
        var_dump($host);
    }
