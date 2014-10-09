<?php

/**
 * 通用模板管理
 * */
class ShoptmplsAction extends UserAction {

    public function index() {
        $db = D('Wxuser');
        $where['token'] = session('token');
        $where['uid'] = session('uid');
        $info = $db->where($where)->find();
        $this->assign('info', $info);
        //模板提示信息
        $desinfo[1]= "全新商城模板，随机颜色，时尚大方，不支持首页幻灯片";
        $desinfo[2]="支持首页幻灯片展示，可在商城回复配置里添加幻灯片";
        $desinfo[3]="时尚简约大方商城首页模板，背景图为商城回复配置里幻灯片的第一张图片";
        $desinfo[4]="列表式图片模版，缩略图建议使用150*150或近似尺寸比例的图片。";
        $desinfo[5]="文字标签式模版，顶部幻灯片尺寸为640*320或近似等比例图片。";
        $desinfo[6]="";
        $desinfo[7]="";
        $desinfo[8]="";
        $desinfo[9]="";
        $desinfo[10]="";
        $desinfo[11]="左右图文式模版，顶部幻灯片建议使用尺寸为640*320或近似等比例图片；分类图片建议使用450*300或近似等比例图片，请不要使用高度大于或接近于宽度的图片。";
        $desinfo[12]="";
        $desinfo[13]="";
        $desinfo[14]="";
        $desinfo[15]="";
        $desinfo[16]="图片式模板，顶部幻灯片建议尺寸为宽640*高320或近似等比例的图片，文字为分类名称及分类描述，名称建议4个字符，描述限制10个字符以内；图片为分类封面，建议尺寸为宽165*高100或近似等比例图片";
        $desinfo[17]="图标式模板";
        $desinfo[18]="图标式模板，顶部幻灯片建议尺寸为宽640*高320或近似等比例的图片。";
        $desinfo[19]="图标式模板，顶部幻灯片建议尺寸为宽640*高320或近似等比例的图片。";
        $desinfo[20]="支持二级分类，顶部幻灯片建议尺寸为宽640*高320或近似等比例的图片，幻灯下4个图标为分类管理的前4个分类，图标下第一块内容为第五个分类的分类封面、分类名称及子分类名称，建议尺寸300*300或1:1图片，下面依次类推。";
        $desinfo[21]="图标式模板，顶部幻灯片建议尺寸为宽640*高320或近似等比例的图片，分类前8个为图标及文字展示，后面分类为图片展示，建议尺寸为宽150*高90或等比例图片。";
        $desinfo[22]="图标式模板，按分类顺序依次展现，有图片显示的分类，图片尺寸建议为宽150*85高或的等比例图片。";
        $desinfo[23]="汽车行业专属模板，顶部幻灯片建议尺寸为宽640*高320或近似等比例的图片，幻灯下4个图标为分类管理的前4个分类，后面分类依次展示，图片建议尺寸为宽310*高130或等比例图片，logo图标为官网logo，需等比尺寸的png格式图片。";
        $desinfo[24]="此模板适合做简单版纯展示的会员卡，头部图片就是首页封面图，宽720高随便，如果用幻灯片记住一定要相同的尺寸。小图标尺寸是正方形300x300,一个分类一页显示8个二级分类。";
        $desinfo[25]="左右双栏模版，顶部幻灯片尺寸为640*320或近似等比例图片，如使用正方形图片会使得页面不美观；分类图片建议使用300*200或近似等比例图片，使用宽度小于高度的(如200*300)尺寸图片将使页面惨不忍睹。";
        $desinfo[26]="图标式模版，顶部幻灯片建议使用尺寸为640*320或近似等比例图片；分类图片请使用正方形尺寸的图片。";
        $desinfo[27]="";
        $desinfo[28]="图标式模版，顶部幻灯片建议使用尺寸为640*320或近似等比例图片；分类图片请使用正方形尺寸的图片。";
        $desinfo[29]="图标式模版，顶部幻灯片建议使用尺寸为640*320或近似等比例图片；分类图片请使用正方形尺寸的图片。";
        $desinfo[30]="图标式模版，顶部幻灯片建议使用尺寸为640*320或近似等比例图片；分类图片请使用正方形尺寸的图片。";
        $desinfo[31]="此模板适合做简单版纯展示的会员卡，头部图片就是首页封面图，宽720高随便，如果用幻灯片记住一定要相同的尺寸。小图标尺寸是正方形300x300,一个分类一页显示8个二级分类。";
        $desinfo[32]="此模板适合做简单版纯展示的会员卡，头部图片就是首页封面图，宽720高随便，如果用幻灯片记住一定要相同的尺寸。小图标尺寸是正方形300x300,一个分类一页显示6个二级分类。";
        $desinfo[33]="此模板支持二级分类，适合分类比较多的地方公众号，小图标为正方形300x300px。";
        $desinfo[34]="此模板支持二级分类，适合分类比较多的地方公众号，小图标为正方形300x300px。";
        $desinfo[35]="此模板支持二级分类，适合分类比较多的地方公众号，前4个一级分类可以突出显示，小图标";
		$desinfo[36]="";
		$desinfo[37]="";
        
        $this->assign('desinfo',$desinfo);
        //
        $this->display();
    }

    public function add() {
        $gets = $this->_get('style');
        $db = M('Wxuser');
        switch ($gets) {
            case 1:
                $data['shoptpltypeid'] = 1;
                $data['shoptpltypename'] = '101_index_wis2a';
                break;
            case 2:
                $data['shoptpltypeid'] = 2;
                $data['shoptpltypename'] = '102_index_wis4a';
                break;
            case 3:
                $data['shoptpltypeid'] = 3;
                $data['shoptpltypename'] = '103_index';
                break;
            case 4:
                $data['shoptpltypeid'] = 4;
                $data['shoptpltypename'] = '104_index';
                break;
            case 5:
                $data['shoptpltypeid'] = 5;
                $data['shoptpltypename'] = '105_index';
                break;
            case 6:
                $data['shoptpltypeid'] = 6;
                $data['shoptpltypename'] = '106_index';
                break;
            case 7:
                $data['shoptpltypeid'] = 7;
                $data['shoptpltypename'] = '107_index';
                break;
            case 8:
                $data['shoptpltypeid'] = 8;
                $data['shoptpltypename'] = '108_index';
                break;
            case 9:
                $data['shoptpltypeid'] = 9;
                $data['shoptpltypename'] = '109_index';
                break;
            case 10:
                $data['shoptpltypeid'] = 10;
                $data['shoptpltypename'] = '110_index';
                break;
            case 11:
                $data['shoptpltypeid'] = 11;
                $data['shoptpltypename'] = '111_index';
                break;
            case 12:
                $data['shoptpltypeid'] = 12;
                $data['shoptpltypename'] = '112_index';
                break;
            case 13:
                $data['shoptpltypeid'] = 13;
                $data['shoptpltypename'] = '113_index_jks6z';
                break;
            case 14:
                $data['shoptpltypeid'] = 14;
                $data['shoptpltypename'] = '114_index_mnsz6';
                break;
			case 15:
                $data['shoptpltypeid'] = 15;
                $data['shoptpltypename'] = '115_index_ms76x';
                break;
            case 16:
                $data['shoptpltypeid'] = 16;
                $data['shoptpltypename'] = '116_index_ms76x';
                break;
            case 17:
                $data['shoptpltypeid'] = 17;
                $data['shoptpltypename'] = '117_index_usn3x';
                break;
            case 18:
                $data['shoptpltypeid'] = 18;
                $data['shoptpltypename'] = '118_index_jge3';
                break;
            case 19:
                $data['shoptpltypeid'] = 19;
                $data['shoptpltypename'] = '119_index_jsg2';
                break;
            case 20:
                $data['shoptpltypeid'] = 20;
                $data['shoptpltypename'] = '120_index_pfs9';
                break;
            case 21:
                $data['shoptpltypeid'] = 21;
                $data['shoptpltypename'] = '121_index_eor5w';
                break;
            case 22:
                $data['shoptpltypeid'] = 22;
                $data['shoptpltypename'] = '122_index_pgj9d';
                break;
            case 23:
                $data['shoptpltypeid'] = 23;
                $data['shoptpltypename'] = '123_index_jge4s';
                break;
            case 24:
                $data['shoptpltypeid'] = 24;
                $data['shoptpltypename'] = '124_index_ghe5s';
                break;
            case 25:
                $data['shoptpltypeid'] = 25;
                $data['shoptpltypename'] = '125_index_gjnh4';
                break;
            case 26:
                $data['shoptpltypeid'] = 26;
                $data['shoptpltypename'] = '126_index_gjj0f';
                break;
            case 27:
                $data['shoptpltypeid'] = 27;
                $data['shoptpltypename'] = '127_index_jpr4g';
                break;
            case 28:
                $data['shoptpltypeid'] = 28;
                $data['shoptpltypename'] = '128_index_pgj3f';
                break;
            case 29:
                $data['shoptpltypeid'] = 29;
                $data['shoptpltypename'] = '129_index_fds3f';
                break;
            case 30:
                $data['shoptpltypeid'] = 30;
                $data['shoptpltypename'] = '130_index_ves7g';
                break;
            case 31:
                $data['shoptpltypeid'] = 31;
                $data['shoptpltypename'] = '131_index_win6a';
                break;
            case 32:
                $data['shoptpltypeid'] = 32;
                $data['shoptpltypename'] = '132_index_wio1a';
                break;
            case 33:
                $data['shoptpltypeid'] = 33;
                $data['shoptpltypename'] = '133_index_wis2a';
                break;
            case 34:
                $data['shoptpltypeid'] = 34;
                $data['shoptpltypename'] = '134_index_viw3a';
                break;
            case 35:
                $data['shoptpltypeid'] = 35;
                $data['shoptpltypename'] = '135_index_you4a';
                break;
			case 36:
                $data['shoptpltypeid'] = 36;
                $data['shoptpltypename'] = '136_index_esfsd344';
                break;
			case 37:
                $data['shoptpltypeid'] = 37;
                $data['shoptpltypename'] = '137_index_esfsd344';
                break;
			case 38:
                $data['shoptpltypeid'] = 38;
                $data['shoptpltypename'] = '138_index_esfsd344';
                break;
			case 39:
                $data['shoptpltypeid'] = 39;
                $data['shoptpltypename'] = '139_index_esfsd344';
                break;
        }
        $where['token'] = session('token');
        $db->where($where)->save($data);
        //
        M('Home')->where(array('token'=>session('token')))->save(array('advancetpl'=>0));
        if (isset($_GET['noajax'])) {
        	$this->success('设置成功','/index.php?g=User&m=Shoptmpls&a=index&token='.$this->token);
        }
    }
}

 

   
?>