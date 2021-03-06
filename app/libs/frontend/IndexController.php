<?php
namespace app\libs\frontend;

use Api;

class IndexController extends BaseController{

    /**
     * 首页
     * @param  [type] $cid  [description]
     * @param  [type] $page [description]
     * @return [type]       [description]
     */
    public static function index() {

        $data['name'] = '昵称';
        $data['age'] = '26';
        $data['title'] = '地球村';
        $data['english'] = 'baidu.com';

        //$srt = Api::fun()->getRSA('re',$data);
        //echo $srt.PHP_EOL;
        //$srt = Api::fun()->getRSA('ud',$srt);
        //echo $srt.PHP_EOL;
        //$srt = Api::fun()->getRSA('ue',$data);
        //echo $srt.PHP_EOL;
        //$srt = Api::fun()->getRSA('rd',$srt);
        //echo $srt.PHP_EOL;
        //$srt1 = Api::fun()->getRSA('rs',$data);
        //echo $srt1.PHP_EOL;
        //$srt = Api::fun()->getRSA('uv',$data,$srt1);
        //echo $srt.PHP_EOL;
        //$srt = Api::fun()->getRSA('tv',$data,$srt1,'alipay'); // 留空为公共密钥，alipay为第三次密钥
        //echo $srt.PHP_EOL;

        Api::render('index', array('site_url' => Api::fun()->getSiteURL(),'title' => Api::fun()->getTitle(),'timeout' => Api::fun()->getTimeOut()));
    }

    public static function terms() {
        $section = '<section class="terms">
    <h2>'.Api::fun()->getTitle().'用户服务条款</h2>

    <p>欢迎您来到'.Api::fun()->getTitle().'（以下简称“本网站”）。</p>
    <p>本网站由 XX市'.Api::fun()->getTitle().'科技有限公司（以下简称“'.Api::fun()->getTitle().'”）运行维护。</p>
    <p>请您仔细阅读以下条款，如果您对本协议的任何条款表示异议，您可以选择不进入'.Api::fun()->getTitle().'。当您注册成功，无论是进入'.Api::fun()->getTitle().'，还是在'.Api::fun()->getTitle().'上发布任何内容（即「内容」），均意味着您（即「用户」）完全接受本协议项下的全部条款。</p>

    <h4>使用规则</h4>
    <p>1、用户注册成功后，本网站将给予每个用户一个用户帐号及相应的密码，该用户帐号和密码由用户负责保管，用户不应将账号或密码告知第三方，或者将其帐号、密码转让、出借予他人使用或与第三方共用。如用户发现其帐号遭他人非法使用，应立即通知本网站，因黑客行为或用户的保管疏忽等非本网站原因导致帐号、密码遭他人非法使用或无法正常使用的，本网站不承担任何责任；用户应当对以其用户帐号进行的所有活动和事件负法律责任。</p>
    <p>2、用户应提供及时、详尽及准确的个人资料，并不断更新注册资料，用户须对在本网站的注册信息的真实性、合法性、有效性承担全部责任，用户不得冒充他人；不得利用他人的名义发布任何信息；不得恶意使用注册帐号导致其他用户误认；否则'.Api::fun()->getTitle().'有权立即停止提供服务，收回其帐号并由用户独自承担由此而产生的一切法律责任。</p>
    <p>3、用户直接或通过各类方式（如RSS源和站外API引用等）间接使用本网站服务和数据的行为，都将被视作已无条件接受本协议全部内容；若用户对本协议的任何条款存在异议，请停止使用'.Api::fun()->getTitle().'所提供的全部服务。</p>
    <p>4、本网站是一个信息分享、传播及获取的平台，用户通过'.Api::fun()->getTitle().'发表的信息为公开的信息，其他第三方均可以通过本网站获取用户发表的信息，用户对任何信息的发表即认可该信息为公开的信息，并单独对此行为承担法律责任；任何用户不愿被其他第三人获知的信息都不应该在本网站上进行发表。</p>
    <p>5、用户承诺不得以任何方式利用本网站直接或间接从事违反中国法律以及社会公德的行为，本网站有权对违反上述承诺的内容予以删除。</p>
    <p>6、用户不得利用'.Api::fun()->getTitle().'服务制作、上载、复制、发布、传播或者转载如下内容：</p>
    <ul>
        <li>_反对宪法所确定的基本原则的；</li>
        <li>_危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；</li>
        <li>_损害国家荣誉和利益的；</li>
        <li>_煽动民族仇恨、民族歧视，破坏民族团结的；</li>
        <li>_破坏国家宗教政策，宣扬邪教和封建迷信的；</li>
        <li>_散布谣言，扰乱社会秩序，破坏社会稳定的；</li>
        <li>_散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的；</li>
        <li>_侮辱或者诽谤他人，侵害他人合法权益的；</li>
        <li>_含有法律、行政法规禁止的其他内容的信息。</li>
    </ul>
    <p>7、本网站有权对用户使用本网站的情况进行审查和监督，如用户在使用本网站时违反任何上述规定，本网站或其授权的人有权要求用户改正或直接采取一切必要的措施（包括但不限于更改或删除用户张贴的内容、暂停或终止用户使用本网站的权利），因此产生的全部责任及损失由用户承担。</p>

    <h4>知识产权</h4>
    <p>本网站是一个信息获取、分享及传播的平台，我们尊重和鼓励本网站用户创作的内容，认识到保护知识产权对'.Api::fun()->getTitle().'生存与发展的重要性，承诺将保护知识产权作为本网站运营的基本原则之一。</p>
    <p>1、用户在本网站发表的全部原创内容（包括但不仅限于回答、文章和评论），著作权均归用户本人所有。用户可授权第三方以任何方式使用，不需要得到'.Api::fun()->getTitle().'的同意。</p>
    <p>2、本网站提供的网络服务中包含的标识、版面设计、排版方式、文本、图片、图形等均受著作权法、商标法及其它法律保护，未经相关权利人（含本网站及其他原始权利人）同意，上述内容均不得在任何平台被直接或间接发布、使用、出于发布或使用目的的改写或再发行，或以其他任何法律允许外的方式使用。</p>
    <p>3、为了促进知识的分享和传播，用户将其在本网站发表的全部内容，授予本网站免费的、不可撤销的、非独家、永久的、全球范围内的使用许可，本网站有权将该内容用于本网站各种形态的产品和服务上，包括但不限于网站以及发表的应用或其他互联网产品。</p>
    <p>4、除原作者另有说明或法律规定不得转载的情况外，若出于非商业目的，将用户在本网站发表的内容转载在本网站之外的地方，应当在作品的正文开头的显著位置注明原作者姓名（或原作者在本网站使用的帐号名称），给出原始链接，注明「发表于'.Api::fun()->getTitle().'」，并不得对作品进行修改演绎。若需要对作品进行修改，或用于商业目的，应当联系用户获得单独授权，按照用户规定的方式使用该内容。</p>
    <p>5、在本网站上传或发表的内容，用户应保证其为相关权利所有人或已取得合法授权，并且该内容不会侵犯任何第三方的合法权益。如果第三方提出关于著作权等合法权益的异议，本网站有权删除相关内容，且有权追究用户的法律责任。给本网站或任何第三方造成损失的，用户应负责全额赔偿。</p>
    <p>6、如果任何第三方侵犯了本网站用户相关的权利，用户同意授权'.Api::fun()->getTitle().'或其指定的代理人代表'.Api::fun()->getTitle().'自身或用户对该第三方提出警告、投诉、发起行政执法、诉讼、进行上诉，或谈判和解，并且用户同意在'.Api::fun()->getTitle().'认为必要的情况下参与共同维权。</p>
    <p>7、本网站有权但无义务对用户发布的内容进行审核，有权根据相关证据结合《侵权责任法》、《信息网络传播权保护条例》等法律法规及本网站社区指导原则对侵权信息进行处理。</p>

    <h4>个人信息</h4>
    <p>1、用户同意本网站出于以下目的，收集和使用用户的个人信息：</p>
    <ul>
        <li>（1）在用户注册'.Api::fun()->getTitle().'账号时，本网站会收集用户的昵称、性别和手机号码；</li>
        <li>（2）本网站会收集用户在完善个人资料时填写的出生日期、居住地区、邮箱、QQ联系、工作职位等个人信息；</li>
        <li>（3）在用户使用'.Api::fun()->getTitle().'时，本网站会收集用户的浏览器/移动设备类型、浏览器/移动设备语言、用户IP地址等信息；</li>
        <li>（4）若用户使用'.Api::fun()->getTitle().'的“求职/招聘”服务，本网站会收集用户填写的简历信息（包括年龄、性别、手机号、邮箱、项目经历、工作经历、教育经历）；</li>
        <li>（5）若用户使用第三方帐号（微信、QQ、GitHub、Stack Overflow、LinkedIn）登录，本网站会读取并获得用户在该第三方平台上登记、公布、记录的公开信息（包括昵称、头像）；</li>
        <li>（6）开展内部审计、数据分析和研究，改善'.Api::fun()->getTitle().'的产品或服务。</li>
    </ul>
    <p>2、'.Api::fun()->getTitle().'尊重并保护访问本网站的任何个人的个人信息。对于您提供的非公开的个人信息，本网站不会将其提供给第三方，但下述情况除外：</p>
    <ul>
        <li>（1）事先获得您的明确授权；</li>
        <li>（2）为使用'.Api::fun()->getTitle().'的服务所必须的（包括但不限于使用“求职/招聘”服务时本网站向用人单位提供您的简历信息）；</li>
        <li>（3）司法机关、行政机关或其他有关部门要求披露的；</li>
        <li>（4）为维护本网站及'.Api::fun()->getTitle().'的合法权益、社会公众利益需要披露的；</li>
        <li>（5）本网站与第三方合作向用户提供相关网络服务需要向第三方披露的；</li>
        <li>（6）依照法律法规要求披露的。</li>
    </ul>
    <p>3、以下情形造成的任何个人信息的泄露、丢失、被盗用、被篡改等，本网站及'.Api::fun()->getTitle().'不承担任何责任：</p>
    <ul>
        <li>（1）由黑客攻击、计算机病毒侵入或发作、政府管制等本网站及'.Api::fun()->getTitle().'不能控制的原因或不可抗力而造成的暂时性关闭等影响网站正常运营的事件所造成的；</li>
        <li>（2）用户将个人密码、账号告知他人或与他人共享注册帐号所造成的；</li>
        <li>（3）与本网站链接的任何其它网站造成的。</li>
    </ul>

    <h4>侵权处理</h4>
    <p>用户在'.Api::fun()->getTitle().'发表的内容仅表明其个人的立场和观点，并不代表本网站的立场或观点。如果个人或企业发现本网站存在侵犯自身合法权益的内容，可以先尝试与作者取得联系，通过沟通协商解决问题。如您无法联系到作者，或无法通过与作者沟通解决问题，您可通过向'.Api::fun()->getTitle().'平台进行投诉。本网站有权直接采取包括但不限于更改或删除用户张贴的内容、暂停或终止用户使用本网站的权利等一切措施，因此产生的全部责任及损失由用户承担。</p>
    <p>不论本侵权举报内容是否完全属实，用户将承担由此产生的一切法律责任，并承担和赔偿本网站因根据投诉人的通知书对相关帐号的处理而造成的任何损失，包括但不限于本网站因向被投诉方赔偿而产生的损失及'.Api::fun()->getTitle().'名誉、商誉损害等。</p>

    <h4>免责申明</h4>
    <p>1、'.Api::fun()->getTitle().'不能对用户发表的回答或评论的正确性进行保证。</p>
    <p>2、用户在本网站发表的内容仅表明其个人的立场和观点，并不代表本网站的立场或观点。作为内容的发表者，需自行对所发表内容负责，因所发表内容引发的一切纠纷，由该内容的发表者承担全部法律及连带责任。本网站不承担任何法律及连带责任。</p>
    <p>3、'.Api::fun()->getTitle().'不保证网络服务一定能满足用户的要求，也不保证网络服务不会中断，对网络服务的及时性、安全性、准确性也都不作保证。</p>
    <p>4、对于因不可抗力或'.Api::fun()->getTitle().'不能控制的原因造成的网络服务中断或其它缺陷，'.Api::fun()->getTitle().'不承担任何责任，但将尽力减少因此而给用户造成的损失和影响。</p>

    <h4>协议修改</h4>
    <p>1、根据互联网的发展和有关法律、法规及规范性文件的变化，或者因业务发展需要，本网站有权对本协议的条款作出修改或变更，一旦本协议的内容发生变动，本网站将公布修改之后的协议内容，该公布行为视为'.Api::fun()->getTitle().'已经通知用户修改内容。'.Api::fun()->getTitle().'也可采用电子邮件或私信的传送方式，提示用户协议条款的修改、服务变更、或其它重要事项。</p>
    <p>2、如果不同意'.Api::fun()->getTitle().'对本协议相关条款所做的修改，用户有权并应当停止使用本网站。如果用户继续使用本网站，则视为用户接受本网站对本协议相关条款所做的修改。</p>
</section>';
        Api::render('terms_privacy', array('site_url' => Api::fun()->getSiteURL(),'title' => '服务条例 - '.Api::fun()->getTitle(),'section' => $section));
    }

    public static function privacy() {
        $section = '<section class="terms">
    <h2>帐号隐私政策</h2>
    
    <p>最新更新时间：2021年1月1日</p>
    <h4>欢迎来到'.Api::fun()->getTitle().' !</h4>
    <p> <span class="terms_span"> XX市'.Api::fun()->getTitle().'科技有限公司</span>（以下称“<strong>'.Api::fun()->getTitle().'</strong>”）致力于保个人信息指与已识别或可识别的自然人有关的任何信息。根据相关法律依据《中华人民共和国网络安全法》、《信息安全技术 个人信息安全规范》（GB/T 35273-2017）以及其他相关法律法规，保护和尊重您的隐私。'.Api::fun()->getTitle().'在您使用'.Api::fun()->getTitle().'的帐号、网站、移动应用程序或其他产品和服务（以下称“<span class="terms_span"><strong>产品</strong></span> ”）的过程中，'.Api::fun()->getTitle().'可能会收集和使用您的个人信息，无论您是否注册帐号，以帮助'.Api::fun()->getTitle().'向您提供更优质的产品服务。</p>
    <p>'.Api::fun()->getTitle().'将通过本隐私政策向您说明产品收集和使用您的个人信息的目的、方式和范围，您对您的个人信息的权利，以及向您阐述'.Api::fun()->getTitle().'为保护信息安全所采取的安全保护措施。</p>
    <p>本隐私政策为'.Api::fun()->getTitle().'所有产品统一适用的通用规则，除了本隐私政策外，'.Api::fun()->getTitle().'还会针对部分产品制定专门的隐私条款，以向您更为具体地说明该产品或服务有关的个人信息的收集和使用规则。如某款产品有单独的隐私条款，则该产品的隐私条款将优先适用。该产品隐私条款未涵盖的内容，适用本隐私政策。</p>

    <h4>请在使用'.Api::fun()->getTitle().'的产品之前，仔细阅读本隐私政策，了解'.Api::fun()->getTitle().'针对客户隐私的做法。</h4>
    <p>本隐私政策将帮助您了解以下内容：</p>
    <p>一、'.Api::fun()->getTitle().'如何收集和使用您的个人信息</p>
    <p>二、'.Api::fun()->getTitle().'如何使用 Cookies 和同类技术 </p>
    <p>三、'.Api::fun()->getTitle().'如何保留、转让共享、公开披露您的个人信息</p>
    <p>四、'.Api::fun()->getTitle().'如何保护您的个人信息</p>
    <p>五、您处置您的个人信息的权利</p>
    <p>六、'.Api::fun()->getTitle().'如何处理儿童的个人信息</p>
    <p>七、第三方服务提供商及其服务</p>
    <p>八、本隐私政策如何更新</p>

    <h4>一、'.Api::fun()->getTitle().'如何收集和使用您的个人信息</h4>
    <p>'.Api::fun()->getTitle().'收集个人信息以便更高效的运营并为您提供最佳的使用体验。'.Api::fun()->getTitle().'收集个人信息的渠道包括：</p>
    <ul>
        <li>（1）您直接向'.Api::fun()->getTitle().'提供信息；</li>
        <li>（2）您在使用产品过程中'.Api::fun()->getTitle().'获取的相关信息；</li>
        <li>（3）从第三方处获取有关您的个人信息。</li>
    </ul>
    <p>'.Api::fun()->getTitle().'收集的信息取决于您实际使用的产品、您与'.Api::fun()->getTitle().'互动的环境、您所做的选择，包括您的隐私设置以及您所使用的产品和功能。'.Api::fun()->getTitle().'的产品和功能包括核心业务功能和增值业务功能。<strong> 在'.Api::fun()->getTitle().'收集信息时，您并非必须向'.Api::fun()->getTitle().'提供个人信息，对于核心业务功能，如果您选择不提供，'.Api::fun()->getTitle().'可能将无法为您提供相关的产品，也无法回应或解决您所遇到的问题。对于增值业务功能，您可以选择是否同意'.Api::fun()->getTitle().'收集信息，如果您拒绝同意，将可能导致相关增值业务功能无法实现，但不影响您使用'.Api::fun()->getTitle().'的核心业务功能</strong>。</p>

    <h4>1.'.Api::fun()->getTitle().'收集的个人信息</h4>
    <h5>（1）您直接向'.Api::fun()->getTitle().'提供信息。</h5>
    <p>a.您需要注册帐号才能享受某些 产品或相关服务。当您<strong>注册或登录帐号时</strong>，'.Api::fun()->getTitle().'可能会收集您的<strong>手机号码或邮箱地址、密码、用户名、性别、注册短信内容、头像</strong>等信息；其中，手机号码或邮箱地址、密码为帐号注册、登录必要的信息，如果您不提供上述信息，'.Api::fun()->getTitle().'将无法为您提供帐号注册或登录服务；</p>
    <p>b.若您所在的国家相关法律法规有实名认证规定，'.Api::fun()->getTitle().'还将收集您的<strong>实名认证信息，如您的姓名、身份证号码</strong>等，如您拒绝提供，'.Api::fun()->getTitle().'有可能无法为您提供相应的产品或服务；如果您使用帐号登录其他第三方的产品或服务，'.Api::fun()->getTitle().'也可能从这些产品或服务中获得您的实名认证信息，并将这些信息与您提供给'.Api::fun()->getTitle().'的实名认证信息进行验证，以保证您身份的唯一性。</p>
    <p>c.如果您向'.Api::fun()->getTitle().'订购产品、申请退货或退款或使用收费服务（例如开源好物的兑换或者购买），'.Api::fun()->getTitle().'可能会收集您的<strong>交货详情、银行账号、支付记录、账单地址以及其他财务信息、联系及交流的记录</strong>等，以便'.Api::fun()->getTitle().'处理您的订单。如果您不提供这些信息，将可能无法向'.Api::fun()->getTitle().'订购产品、申请退货或退款或使用收费服务。</p>
    <p>d.在向您提供售后服务和客户支持时，'.Api::fun()->getTitle().'可能会要求您提供和收集您的个人信息，如 设备信息、您的姓名、手机号码、邮箱地址、地址等，并可能对您与'.Api::fun()->getTitle().'客服的沟通进行录音或者保存。</p>
    <p>e.'.Api::fun()->getTitle().'可能会在其他时间，要求您提供和收集您的个人信息，包括参与抽奖或比赛、参加'.Api::fun()->getTitle().'自办或业务合作伙伴组织的推广活动或营销活动、填写问卷调查表、参加'.Api::fun()->getTitle().'自办或业务合作伙伴主办的用户论坛或博客。</p>
    <p>f.根据某些产品的特点，'.Api::fun()->getTitle().'可能还会在其他场景下要求您提供和收集您的个人信息，'.Api::fun()->getTitle().'会在相关产品的单独隐私条款中向您告知。</p>
    <h5>（2）您在使用产品过程中'.Api::fun()->getTitle().'获取的相关信息</h5>
    <p>在您使用产品过程中，'.Api::fun()->getTitle().'会收集您的设备信息，以及您和您的设备如何与产品或服务交互的信息，包括：</p>
    <p>a.设备信息：例如设备名称、设备型号、IMEI 号码、手机型号、Mac 地址、序列号、IP 地址、操作系统版本等。</p>
    <p>b.日志信息和操作记录：例如记录您帐号登录后的操作行为（包括<strong>修改密码、修改绑定的手机号码</strong>、邮箱号码等），使用产品的时间和持续时间、通过服务输入的搜索查询字词，软件的事件信息（如重启、升级、错误、崩溃等）。</p>
    <p>c.位置信息：例如设备的 GPS 信号或有关附近 WiFi 接入点和手机信号塔的信息、设备位置 ID、网络服务提供商 ID。'.Api::fun()->getTitle().'将询问您希望启用的基于位置的应用程序。您可以从设备设置中修改您设备的位置设置，例如更改或禁用基于位置服务的服务所使用的方法和服务器、或修改位置信息的准确性，从而更改提供给'.Api::fun()->getTitle().'的位置信息。</p>
    <p>d.'.Api::fun()->getTitle().'的某些产品允许您与其他人通信、共享。出于技术需要，通信、共享内容可能会通过'.Api::fun()->getTitle().'的系统进行传输并存储在系统中。</p>
    <p>e.根据某些产品的特点，'.Api::fun()->getTitle().'会单独请求您开通特定的用户权限或者获取您其他类型的个人信息，'.Api::fun()->getTitle().'会在相关产品的单独隐私条款中向您告知。</p>
    <h5>（3）从第三方获取的信息 </h5>
    根据某些产品的特点，在法律允许的情况下，'.Api::fun()->getTitle().'可能从公共或商用来源获取有关您的数据，并可能将其与收到的或与您有关的其他信息结合。例如，为实现帐号的积分、会员等功能，'.Api::fun()->getTitle().'会收集您在支持帐号的'.Api::fun()->getTitle().'关联公司或第三方产品中的与帐号相关的数据（包括登录地址、登录时间、时长等）以及其他经您授权共享的数据。
    <h5>2.'.Api::fun()->getTitle().'如何使用您的个人信息</h5>
    <p>当'.Api::fun()->getTitle().'需要履行在用户协议和/或服务合同下对您的义务、或'.Api::fun()->getTitle().'受约束的法定义务或者经由评估'.Api::fun()->getTitle().'认为对于保护'.Api::fun()->getTitle().'或第三方的合法利益有必要时，'.Api::fun()->getTitle().'将在取得你同意的前提下，出于本隐私政策中描述的目的对你的个人信息进行处理。'.Api::fun()->getTitle().'将严格遵守本隐私政策及其更新所载明的内容来使用您的个人信息。'.Api::fun()->getTitle().'会将您的个人信息用于以下目的：</p>
    <p>（1）<strong>创建和维护您的帐号。</strong>'.Api::fun()->getTitle().'将使用数据创建和维护您的帐号。</p>
    <p>（2）<strong>处理订购单。</strong>'.Api::fun()->getTitle().'将使用数据处理订购单和相关的售后服务，包括客户支持、订单配送、发票打印、商品兑换等。</p>
    <p>（3）<strong>提供通知和推送服务。</strong>'.Api::fun()->getTitle().'可能使用您的数据向您提供 产品或第三方的内容推送或通知服务，包括资讯、软件更新和安装、销售和促销信息等。</p>
    <p>（4）<strong>提供基于位置的服务。</strong>'.Api::fun()->getTitle().'或第三方将使用位置信息以为您提供更具针对性地服务，以获得尽可能好的用户体验，例如天气信息、配送信息、具有地域针对性的产品消息推送服务。</p>
    <p>（5）<strong>登录支持帐号的关联公司或第三方提供的产品与服务。</strong>通过帐号您可以登录支持帐号的关联公司或第三方提供的产品与服务，包括gitee等。</p>
    <p>（6）<strong>实现虚拟货币、会员等用户权益。</strong>'.Api::fun()->getTitle().'会收集和同步您在产品、支持帐号的'.Api::fun()->getTitle().'的关联公司或第三方提供的产品与服务中的与帐号相关的行为数据，用于实现相关用户权益。</p>
    <p>（7）<strong>产品改进和用户体验改善。</strong>'.Api::fun()->getTitle().'会把通过帐号注册、用户活动获取的手机号用于向用户调研、回访。</p>
    <p>（8）<strong>客户支持。</strong>'.Api::fun()->getTitle().'使用数据来诊断产品问题，并提供其他客户关怀和支持服务。'.Api::fun()->getTitle().'还可能收集您的电子邮箱地址，以回复您在'.Api::fun()->getTitle().'网站“联系'.Api::fun()->getTitle().'”部分提出的问题或意见。</p>
    <p>（9）<strong>防止欺诈。</strong>'.Api::fun()->getTitle().'可能会将您提供的数据用于验证您的身份、分析业务运营效率、审查交易以及防止诈骗。</p>
    <p>（11）<strong>为了向您提供个性化服务。</strong>'.Api::fun()->getTitle().'可能将您的个人信息作用户画像和行为分析，以向您展示、推送更适合您的信息、商品或服务等，或更好地进行安全防范和安全保障，例如在内容列表中向您优先展示您可能更感兴趣的新闻、服务或广告。同时，'.Api::fun()->getTitle().'可能会将'.Api::fun()->getTitle().'各类服务中所收集的您的个人信息结合起来，以便整体而言为您提供更优化的产品服务体验。</p>

    <h4>二、'.Api::fun()->getTitle().'如何使用 Cookies 和同类技术</h4>
    <p>1.Cookie 是什么？Cookie 是'.Api::fun()->getTitle().'网站、应用程序或服务传输并存储在您设备上的小文件。'.Api::fun()->getTitle().'网站、在线服务、互动应用程序、电子邮箱和广告可能会使用 Cookie 和其他同类技术，如像素标签和网站信标。Cookie 可能会在您电脑上存储较短时间（如仅在您的浏览器开启时）或较长时间，甚至数年。'.Api::fun()->getTitle().'无法访问不是由'.Api::fun()->getTitle().'设置的 Cookie。</p>
    <p>2.'.Api::fun()->getTitle().'使用的 Cookie 和同类技术</p>
    <ul>
        <li>（1）'.Api::fun()->getTitle().'及'.Api::fun()->getTitle().'的合作伙伴使用 Cookie 或类似的跟踪技术来更好地了解您设备上移动软件的使用情况，了解您使用应用程序的频率、该应用程序内发生的事件、累计使用、性能数据以及从何处下载应用程序。'.Api::fun()->getTitle().'不会将存储于分析软件中的信息链接到您在移动应用程序中提交的任何个人信息。</li>
        <li>（2）'.Api::fun()->getTitle().'及'.Api::fun()->getTitle().'的合作伙伴使用 Cookie 或类似的跟踪技术来分析趋势、管理网站、跟踪网站上的用户行为，并收集'.Api::fun()->getTitle().'用户群的整体受众特征信息。</li>
        <li>（3）许多网络浏览器有Do Not Track（请勿追踪）功能。该功能可向网站发出“Do Not Track”请求。如果您的浏览器启用了Do Not Track，那么'.Api::fun()->getTitle().'所有的网站都会尊重您的选择。</li>
        <li>（4）如大多数网站一样，'.Api::fun()->getTitle().'会自动收集某些信息以分析累积趋势并管理'.Api::fun()->getTitle().'的网站。此信息可能包括互联网协议（IP）地址、浏览器类型、互联网服务提供商（ISP）、引用/退出页面、您在'.Api::fun()->getTitle().'网站上查看的文件（例如 HTML 页面，图形等）、操作系统、日期/时间戳记和/或点击流数据。</li>
        <li>（5）'.Api::fun()->getTitle().'与第三方合作以在'.Api::fun()->getTitle().'网站上展示广告或管理'.Api::fun()->getTitle().'在其他网站上的广告。'.Api::fun()->getTitle().'的授权合作伙伴可能会使用 Cookie 或类似的追踪技术，以根据您的浏览活动和兴趣向您提供广告。如果您想选择退出基于兴趣的广告。请注意，您将继续收到不具有个人针对性的普通广告。</li>
    </ul>
    <p>3.清除/禁用 Cookie管理 Cookie 以及 Cookie 偏好必须在您浏览器的选项/偏好内完成。以下是关于如何在常用浏览器软件中执行此操作的指南：</p>
    <ul>
        <li>（1）<a href="https://support.microsoft.com/en-gb/help/17442/windows-internet-explorer-delete-manage-cookies">Microsoft Internet Explorer</a></li>
        <li>（2）<a href="https://support.microsoft.com/zh-cn/help/4468242/microsoft-edge-browsing-data-and-privacy">Microsoft Edge</a></li>
        <li>（3）<a href="https://support.mozilla.org/en-US/kb/cookies-information-websites-store-on-your-computer">Mozilla Firefox</a></li>
        <li>（4）<a href="https://support.google.com/chrome/answer/95647?hl=en">Google Chrome</a></li>
        <li>（5）<a href="https://support.apple.com/en-gb/guide/safari/sfri11471/mac">Safari for macOS</a></li>
        <li>（6）<a href="https://support.apple.com/en-gb/HT201265">Safari for iOS</a></li>
    </ul>
    <p>4.更多关于 Cookie 的信息关于 Cookie 的详细信息以及关于如何设置您的浏览器来接受、删除或禁用 Cookie 的说明，请参阅 <a href="http://allaboutcookies.org/">www.allaboutcookies.org</a>  。</p>
 
    <h4>三、'.Api::fun()->getTitle().'如何保留、转让共享、公开披露您的个人信息</h4>
    <p>'.Api::fun()->getTitle().'收集的个人信息的保留期限是实现本隐私政策所述收集目的所需的最短时间，除非法律要求更长的保留期限。超过上述保留期限，'.Api::fun()->getTitle().'将删除或匿名化您的个人信息。</p>
    <p>在'.Api::fun()->getTitle().'因特殊原因停止运营'.Api::fun()->getTitle().'的部分或全部产品或服务时，'.Api::fun()->getTitle().'会及时向您告知并停止相关产品或服务的个人信息收集和处理活动，同时将'.Api::fun()->getTitle().'所持有的与该述产品或服务相关的个人信息进行删除或匿名化处理，除非法律法规另有规定。</p>
    <p>在一些情况下，'.Api::fun()->getTitle().'会委托第三方代表'.Api::fun()->getTitle().'处理您的个人信息。例如代表'.Api::fun()->getTitle().'发送短信或电子邮件、提供技术支持的公司，这些公司只能将您的个人信息用于代表'.Api::fun()->getTitle().'向您提供服务。</p>
    <p>'.Api::fun()->getTitle().'可能不时会与其关联公司和与'.Api::fun()->getTitle().'合作提供产品和服务的战略合作伙伴共享部分个人信息，以便提供您要求的产品或服务。</p>
    <p><strong>1.关联公司:</strong>为便于'.Api::fun()->getTitle().'基于帐号向您提供服务，您的个人信息可能会与'.Api::fun()->getTitle().'的关联公司共享。'.Api::fun()->getTitle().'只会共享必要的个人信息，<strong>如果'.Api::fun()->getTitle().'或关联公司改变个人信息的使用及处理目的，将再次征求您的授权同意。</strong></p>
    <p><strong>2.与授权合作伙伴共享：</strong>仅为实现本隐私政策中声明的目的，'.Api::fun()->getTitle().'的某些服务将由授权合作伙伴提供。'.Api::fun()->getTitle().'可能会与合作伙伴共享您的某些个人信息，以提供更好的客户服务和用户体验。'.Api::fun()->getTitle().'的授权合作伙伴包括但不限于码云、众包、物流公司、短信或其他技术服务供应商。例如：当'.Api::fun()->getTitle().'需要向您发放活动奖品时，'.Api::fun()->getTitle().'会将您预留在活动中的联系人信息告知物流公司，以便完成配送。这些第三方不会将这些信息用于任何其它目的。</p>
    <p>3.在涉及合并、收购或破产清算时，如涉及到个人信息转让，'.Api::fun()->getTitle().'会在要求新的持有您个人信息的公司、组织继续受此隐私政策的约束，否则'.Api::fun()->getTitle().'将要求该公司、组织重新向您征求授权同意。如果不涉及个人信息转让，'.Api::fun()->getTitle().'会对您进行充分告知，并将'.Api::fun()->getTitle().'控制的所有个人信息删除或做匿名化处理。</p>
    <p>'.Api::fun()->getTitle().'会通过协议或其他适当措施，要求上述第三方采取相当的保密和安全措施来处理个人信息。</p>
    <p>'.Api::fun()->getTitle().'仅会在以下情况下，公开披露您的个人信息：</p>
    <ul>
        <li>（1）获得您明确同意后；</li>
        <li>（2）基于法律的披露：在法律强制要求遵守传票或其他法律程序、诉讼或政府主管部门强制性要求的情况下，若'.Api::fun()->getTitle().'真诚地相信披露对保护'.Api::fun()->getTitle().'的权利、保护您的安全或他人的安全、调查欺诈或响应政府要求是必要的，'.Api::fun()->getTitle().'可能会披露您的个人信息。</li>
    </ul>

    <h4>四、'.Api::fun()->getTitle().'如何保护您的个人信息</h4>
    <p>'.Api::fun()->getTitle().'采取了合理可行的技术安全和组织措施，以保护所收集的与服务有关的信息。但是请注意，虽然'.Api::fun()->getTitle().'采取了合理的措施保护您的信息，但没有任何网站、Internet 传输、计算机系统或无线连接是绝对安全的。</p>
    <p>'.Api::fun()->getTitle().'已使用符合业界标准的安全防护措施保护您提供的个人信息，防止数据遭到未经授权的访问、公开披露、使用、修改、损坏或丢失。'.Api::fun()->getTitle().'会采取一切合理可行的措施，保护您的个人信息，包括：</p>
    <p>1.'.Api::fun()->getTitle().'使用 SSL 等主流安全技术手段对许多服务进行加密。'.Api::fun()->getTitle().'会定期审查信息收集、存储和处理方面的做法（包括物理性安全措施），以避免各种系统遭到未经授权的访问或篡改。</p>
    <p>2.'.Api::fun()->getTitle().'对个人信息的访问进行严格的权限管控，只允许那些为了帮'.Api::fun()->getTitle().'处理个人信息而需要知晓这些信息的'.Api::fun()->getTitle().'的员工、授权代为处理的服务公司的人员访问个人信息，而且他们需要履行严格的合同保密义务，如果其未能履行这些义务，就可能会被追究法律责任或被终止其与'.Api::fun()->getTitle().'的关系。个人数据的访问日志将被记录，并定期审计。</p>
    <p>3.对'.Api::fun()->getTitle().'来说，您的信息的安全非常重要。因此，'.Api::fun()->getTitle().'将不断努力保障您的个人信息安全，并实施存储和传输全程安全加密等保障手段，以免您的信息在未经授权的情况下被访问、使用或披露。同时，某些加密数据的具体内容，除了用户自己，其他人都无权访问。</p>
    <p>4.'.Api::fun()->getTitle().'在传输和存储您的特殊类型个人信息时，会采用加密等安全措施；存储个人生物识别信息时，将采用技术措施处理后再进行存储，例如仅存储个人生物识别信息的摘要。</p>
    <p>5.'.Api::fun()->getTitle().'会严格筛选业务合作伙伴和服务提供商，将在个人信息保护方面的要求落实到双方的商务合同或审计、考核等活动中。</p>
    <p>6.'.Api::fun()->getTitle().'会举办安全和隐私保护培训课程、测试与宣传活动，加强员工对于保护个人信息重要性的认识。</p>
    <p>7.'.Api::fun()->getTitle().'采用国际及业内认可的标准来保护您的个人信息，并积极通过相关安全与隐私保护认证。</p>
    <p>在发生个人信息安全事件后，'.Api::fun()->getTitle().'将按照相关法律法规的要求，及时向您告知：安全事件的基本情况和可能的影响、'.Api::fun()->getTitle().'已采取或将要采取的处置措施、您可自主防范和降低风险的建议、对您的补救措施等。'.Api::fun()->getTitle().'将及时将事件相关情况以邮件、信函、电话、推送通知等方式告知您。难以逐一告知个人信息主体时，'.Api::fun()->getTitle().'会采取合理、有效的方式发布公告。同时，'.Api::fun()->getTitle().'还将按照监管部门要求，主动上报个人信息安全事件的处置情况。</p>

    <h4>五、您处置您的个人信息的权利</h4>
    <p>'.Api::fun()->getTitle().'尊重您对您个人信息的权利。'.Api::fun()->getTitle().'将严格遵守相关法律法规，采取业内认可的合理可行的措施，保护您的个人信息。防止信息遭到未经授权的访问、披露、使用、修改，避免信息损坏或丢失。</p>
    <p><strong>1.被告知权</strong>'.Api::fun()->getTitle().'通过公布本隐私政策以向您告知'.Api::fun()->getTitle().'如何处理您的个人信息。'.Api::fun()->getTitle().'致力于对您信息的使用的透明性。</p>
    <p><strong>2.访问权:</strong>您可以在'.Api::fun()->getTitle().'的产品或服务界面中直接查询或访问您的个人信息，包括您可以通过产品页面随时登录您的帐号，以访问您帐号有关的个人信息。</p>
    <p><strong>3.更正权：</strong>当您发现'.Api::fun()->getTitle().'处理的关于您的个人信息有错误或不完整时，您有权要求'.Api::fun()->getTitle().'做出更正或进行补充。对于您的部分个人信息，您可以在产品或服务的相关功能页面直接进行更正、修改。对于暂未向您提供自行修改渠道的个人信息，您可以通过联系'.Api::fun()->getTitle().'的 <span class="terms_span">'.Api::fun()->getEmail().'</span> 要求更正或补充您的个人信息。</p>
    <p><strong>4.删除权：</strong>您可以在个人中心-<span class="terms_span">帐号设置</span>中直接删除您所提交的特定信息，如头像、用户名等。在'.Api::fun()->getTitle().'违反'.Api::fun()->getTitle().'与您的约定收集、使用您的个人信息时，您也可以通过联系'.Api::fun()->getTitle().' <span class="terms_span">'.Api::fun()->getEmail().'</span> 要求删除。</p>
    <p><strong>5.注销权：</strong>'.Api::fun()->getTitle().'为您提供帐号注销权，目前您可以联系 <span class="terms_span">'.Api::fun()->getEmail().' 进行删除帐号的操作，'.Api::fun()->getTitle().'可能会要求您提供相关何人信息来验证帐号的归属</span>在您选择注销帐号后，'.Api::fun()->getTitle().'将删除或匿名化您的全部相关个人信息，法律法规另有规定的除外。在您注销后，'.Api::fun()->getTitle().'将无法继续向您提供帐号注册服务及需要使用帐号登录的产品或服务。</p>
    <p><strong>6.投诉权：</strong>您有权通过 <span class="terms_span">'.Api::fun()->getEmail().'</span> 进行投诉。'.Api::fun()->getTitle().'将在收到您投诉之日起十五日内做出答复。如果您对'.Api::fun()->getTitle().'的答复不满意，特别是'.Api::fun()->getTitle().'的个人信息处理行为损害了您的合法权益，您还可以向网信、公安、工商等监管部门进行投诉或举报，或向有管辖权法院提起诉讼。</p>
    <p>请注意，出于安全考虑，在处理您的请求前，'.Api::fun()->getTitle().'可能验证您的身份。对于您合理的请求，'.Api::fun()->getTitle().'原则上不收取费用。但对多次重复、超出合理限度的请求，'.Api::fun()->getTitle().'将视情收取一定成本费用。对于那些无端重复、需要过多技术手段（例如，需要开发新系统或从根本上改变现行惯例）、给他人合法权益带来风险或者非常不切实际的请求，'.Api::fun()->getTitle().'可能会予以拒绝。此外，如果您的请求直接涉及国家安全、国防安全、公共卫生、犯罪侦查等和公共利益直接相关的事由，或者可能导致您或者其他个人、组织的合法权益受到严重损害，'.Api::fun()->getTitle().'可能无法响应您的请求。</p>

    <h4>六、'.Api::fun()->getTitle().'如何处理儿童的个人信息</h4>
    <p>'.Api::fun()->getTitle().'的产品、网站和服务主要面向成人。如果没有父母或监护人的同意，儿童（'.Api::fun()->getTitle().'将不满 14 周岁的任何人均视为儿童）不得使用'.Api::fun()->getTitle().'的产品。对于经父母同意而收集儿童个人信息的情况，'.Api::fun()->getTitle().'只会在受到法律允许、父母或监护人明确同意或者保护儿童所必要的情况下使用或公开披露此信息。如果'.Api::fun()->getTitle().'发现自己在未事先获得可证实的父母同意的情况下收集了儿童的个人信息，则会设法尽快删除相关数据。</p>

    <h4>七、第三方服务提供商及其服务</h4>
    <p>'.Api::fun()->getTitle().'的网站、产品、应用程序和服务可能包含指向第三方网站、产品和服务的链接。 您可以选择是否访问或接受第三方提供的网站、产品和服务。</p>
    <p>'.Api::fun()->getTitle().'无法控制第三方的隐私和数据保护政策，此类第三方不受到本隐私政策的约束。在向第三方提交个人信息之前，请参见这些第三方的隐私保护政策。</p>

    <h4>八、本隐私政策如何更新</h4>
    <p>'.Api::fun()->getTitle().'保留不时更新或修改本隐私政策的权利。'.Api::fun()->getTitle().'会通过不同渠道向您发送变更通知。对于隐私政策的重大变更，若您向'.Api::fun()->getTitle().'提供了电子邮箱，'.Api::fun()->getTitle().'会在变更生效前通过您的电子邮件通知您，否则'.Api::fun()->getTitle().'会在'.Api::fun()->getTitle().'的网站上发布告示或通过'.Api::fun()->getTitle().'的设备向您推送通知。</p>
    <p>本隐私政策容许调整，但未经您明示同意，'.Api::fun()->getTitle().'不会削弱您按照本隐私权政策所享有的权利。</p>
    <p>如您不同意以上隐私政策，'.Api::fun()->getTitle().'将无法收集和使用提供服务所必需的信息，从而无法为您正常提供服务。</p>
    <p>本隐私政策自更新之日起生效。</p>
    <p>如果您对'.Api::fun()->getTitle().'的隐私政策或做法有任何问题或疑虑，请通过以下地址联系'.Api::fun()->getTitle().'：</p>
    <p>电子邮箱：<span class="terms_span">'.Api::fun()->getEmail().'</span></p>
</section>';
        Api::render('terms_privacy', array('site_url' => Api::fun()->getSiteURL(),'title' => '隐私声明 - '.Api::fun()->getTitle(),'section' => $section));
    }

    public static function error() {
        Api::render('error');
    }

}
