# domain
PHP根据url获取顶级域名

####加载

    composer require 'agile/domain'
####使用
    use Agile\Lib\Domain\Domain;
    public function index(Domain $domain)
    {
        $host = $domain->getDomain('http://www.huanguosoft.com');
        var_dump($host);
    }
