<?php
/**
 * PHP检测顶级域名
 * 使用:
 * composer require 'agile/domain:dev-master'
 *
 * use Agile\Lib\Domain\Domain;
 * public function index(Domain $domain)
 * {
 *     $host = $domain->getDomain('http://www.huanguosoft.com');
 *     var_dump($host);
 * }
 *
 * @author 李扬(Andy) <php360@qq.com>
 * @link   http://www.huanguosoft.com
 */
namespace Agile\Lib\Domain;

class Domain
{
    /**
     * 顶级域名后缀
     * @var array
     */
    private $domain;

    public function __construct()
    {
        $this->domain   = array(
            // 顶级域名列表(字母排序)
            'top'       => array(
                'aero','arpa','asia',
                'biz',
                'cat','cc','club','co','com','coop',
                'date',
                'edu',
                'firm',
                'gift','gov',
                'help',
                'info','int',
                'jobs',
                'link',
                'me','mil','mobi','mtn','museum',
                'name','net','news',
                'online','org',
                'part','photo','pics','post','pro',
                'rec','ren',
                'so','studio',
                'tel','top','trade','travel','tv',
                'video',
                'wang','win','wtf',
                'xin','xxx','xyz',
            ),
            // 国家/地区域名列表(字母排序)
            'country'   => array(
                'ac','ad','ae','af','ag','ai','al','am','ao','aq','ar','as','at','au','aw','ax','az',
                'ba','bb','bd','be','bf','bg','bh','bi','bj','bm','bn','bo','br','bs','bt','bw','by','bz',
                'ca','cc','cd','cf','cg','ch','ci','ck','cl','cm','cn','co','cr','cu','cv','cw','cx','cy','cz',
                'de','dj','dk','dm','do','dz',
                'ec','ee','eg','er','es','et','eu',
                'fi','fj','fk','fm','fo','fr',
                'ga','gd','ge','gf','gg','gh','gi','gl','gm','gn','gp','gq','gr','gs','gt','gu','gw','gy',
                'hk','hm','hn','hr','ht','hu',
                'id','ie','il','im','in','io','iq','ir','is','it',
                'je','jm','jo','jp',
                'ke','kg','kh','ki','km','kn','kp','kr','kw','ky','kz',
                'la','lb','lc','li','lk','lr','ls','lt','lu','lv','ly',
                'ma','mc','md','me','mg','mh','mk','ml','mm','mn','mo','mp','mq','mr','ms','mt','mu','mv','mw','mx','my','mz',
                'na','nc','ne','nf','ng','ni','nl','no','np','nr','nu','nz',
                'om',
                'pa','pe','pf','pg','ph','pk','pl','pm','pn','pr','ps','pt','pw','py',
                'qa',
                're','ro','rs','ru','rw',
                'sa','sb','sc','sd','se','sg','sh','si','sk','sl','sm','sn','so','sr','ss','st','su','sv','sx','sy','sz',
                'tc','td','tf','tg','th','tj','tk','tl','tm','tn','to','tr','tt','tv','tw','tz',
                'ua','ug','uk','us','uy','uz',
                'va','vc','ve','vg','vi','vn','vu',
                'wf','ws',
                'ye','yt',
                'za','zm','zw',
            ),
        );
    }

    /**
     * 返回任何url的域名
     *
     * @param  string $url url地址
     * @return string      该url地址的域名
     */
    public function getDomain($url)
    {
        $host = parse_url($url)['host'];
        // 翻转域名数组
        $domain = array_reverse(explode('.', $host));

        $count = count($domain);
        if ($count == 1) {
            // eg:localhost
            return $domain[0];
        } elseif ($count == 2) {
            // eg:xxx.com
            return $domain[1].'.'.$domain[0];
        } else {
            if (in_array($domain[0], $this->domain['country'])) {
                if (in_array($domain[1], $this->domain['top'])) {
                    //eg:abc.xxx.com.cn
                    return $domain[2].'.'.$domain[1].'.'.$domain[0];
                }
                // eg:abc.xxx.com
                return $domain[1].'.'.$domain[0];
            } elseif (in_array($domain[0], $this->domain['top'])) {
                // eg:abc.xxx.com
                return $domain[1].'.'.$domain[0];
            } else {
                // eg:127.0.0.1, test.test
                return $host;
            }
        }
    }
}