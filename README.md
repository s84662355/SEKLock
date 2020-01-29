首先要安装 
https://github.com/s84662355/SEKLock_Server.git


这个工具是因为我觉用redis加锁的话，太麻烦，性能太差了，所以19年初就萌生了想法，做了这个工具出来


laravel的使用方法

composer require chenjiahao/seklock




在app.php文件里加入  SEKLock\SEKLockServiceProvider::class
例如


    'providers' => [
        SEKLock\SEKLockServiceProvider::class,
 

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::clas


php artisan vendor:publish --provider="SEKLock\SEKLockServiceProvider::class"


在sek_lock.php

修改对应的参数
 
 例如secretkey参数就是秘钥 类似密码的存在
return [
     'ip' =>env('SEK_IP', '127.0.0.1') ,
     'port' => env('SEK_PORT',90),
     'secretkey' => env('SEK_SECRETKEY',111111)  ,

];


获取共享锁  $wait_time以毫秒为单位
app('seklock')->getShareLock($lock_name,$wait_time);

获取独占锁
app('seklock')->getUpdateLock($lock_name,$wait_time)


解锁
app('seklock')->unlock($lock_name);