<?php

class AttachmentAction extends UserAction
{
    public function _initialize()
    {
        parent::_initialize();
    }
    public function index()
    {
        $type = $_GET['type'];
        $type = $type ? $type : 'icon';
        $this->assign('type', $type);
        $folder = $_GET['folder'];
        $attachments = $this->files();
        $folders = array();
        $i = 0;
        foreach ($attachments[$type] as $k => $a) {
            array_push($folders, array('name' => $a['name'], 'folder' => $k));
            if ($i == 0 && !$folder) {
                $folder = $k;
            }
            $i++;
        }
        $this->assign('folders', $folders);
        $this->assign('folder', $folder);
        $files = $attachments[$type][$folder]['files'];
        $height = $attachments[$type][$folder]['height'];
        $this->assign('files', $files);
        $this->assign('height', $height);
        $this->assign('siteUrl', C('site_url'));
        $this->display();
    }
    public function files()
    {
        $icons = array('lovely' => array('name' => '卡通图标', 'height' => 60, 'files' => array('1.png', 'backpack-2.png', 'bill.png', 'bookmark.png', 'bookshelf.png', 'briefcase.png', 'bus.png', 'calc.png', 'candy.png', 'car.png', 'chalkboard.png', 'clock.png', 'cloud-check.png', 'cloud-down.png', 'cloud-error.png', 'cloud-refresh.png', 'cloud-up.png', 'donut.png', 'drop.png', 'eye.png', 'flag.png', 'glasses.png', 'glove.png', 'hamburger.png', 'hand.png', 'hotdog.png', 'knife.png', 'label.png', 'map.png', 'map2.png', 'marker.png', 'mcfly.png', 'medicine.png', 'mountain.png', 'muffin.png', 'open-letter.png', 'packman.png', 'paper-plane.png', 'photo.png', 'piggy.png', 'pin.png', 'pizza.png', 'r2d2.png', 'rocket.png', 'skull.png', 'speakers.png', 'store.png', 'tactics.png', 'toaster.png', 'train.png', 'umbrella.png', 'watch.png', 'www.png')), 'colorful' => array('name' => '彩色图标', 'height' => 70, 'files' => array('1.png', '2.png', '3.png', '4.png', '5.png', '6.png', '7.png', '8.png', '9.png', '10.png', '11.png')), 'white' => array('name' => '白色图标', 'height' => 50, 'files' => array('1.png', '2.png', '3.png', '4.png', '5.png', '6.png', '7.png', '8.png', '9.png', '10.png', '11.png', '12.png', '13.png', '14.png', '15.png', '16.png')), 'line' => array('name' => '线条图标', 'height' => 50, 'files' => array('banknote.png', 'bubble.png', 'bulb.png', 'calendar.png', 'camera.png', 'clip.png', 'clock.png', 'cloud.png', 'cup.png', 'data.png', 'diamond.png', 'display.png', 'eye.png', 'fire.png', 'food.png', 'heart.png', 'key.png', 'lab.png', 'like.png', 'location.png', 'lock.png', 'mail.png', 'megaphone.png', 'music.png', 'news.png', 'note.png', 'paperplane.png', 'params.png', 'pen.png', 'phone.png', 'photo.png', 'search.png', 'settings.png', 'shop.png', 'sound.png', 'stack.png', 'star.png', 'study.png', 't-shirt.png', 'tag.png', 'trash.png', 'truck.png', 'tv.png', 'user.png', 'vallet.png', 'video.png', 'vynil.png', 'world.png')));
        $background = array('view' => array('name' => '默认', 'height' => 100, 'files' => array('1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg')));
        $focus = array('default' => array('name' => '默认', 'height' => 70, 'files' => array('1.gif', '2.jpg', '3.jpg', '4.jpg', '5.gif', '6.jpg')));
        $music = array('default' => array('name' => '默认', 'files' => array(array('file' => '1.mp3', 'name' => '汪峰-一起摇摆'), array('file' => '2.mp3', 'name' => '方大同-明天我要嫁给你了'), array('file' => '3.mp3', 'name' => '今天你要嫁给我'))));
        return array('icon' => $icons, 'background' => $background, 'music' => $music, 'focus' => $focus);
    }
    public function my()
    {
        $db = M('Files');
        $where = array('token' => $this->token);
        $count = $db->where($where)->count();
        $Page = new Page($count, 5);
        $show = $Page->show();
        $list = $db->where($where)->limit(($Page->firstRow . ',') . $Page->listRows)->order('id DESC')->select();
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->assign('type', 'my');
        $this->display('index');
    }
}
?>