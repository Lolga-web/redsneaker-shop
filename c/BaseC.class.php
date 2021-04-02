<?php

    /**
     * Базовый контроллер сайта
     */
    abstract class BaseC extends Controller {
        /**
         * @var Twig_Environment $twig Модель шаблонизатора Twig
         * @var PageM $page Модель страницы
         * @var UserM $user Модель пользователя
         * @var CartM $cart Модель корзины
         * @var string $title Заголовок страницы
         * @var string $content Содержание страницы
         * @var string $message вывод сообщения на страницу
         * @var array $user Данные пользователя
         * @var int $cartCount количество товаров в корзине
         */
        protected $title; 
        protected $loader;
        protected $twig;
        protected $content; 
        protected $message;
        protected $page;
        protected $user;
        protected $cart;
        
        public function before(){
            $this->title = 'REDSNEAKER';
            $this->loader = new Twig_Loader_Filesystem('v');
            $this->twig = new Twig_Environment($this->loader); 
            $this->content = '';
            $this->message = '';
            $this->page = new PageM(); // создается экземпляр модели страницы
            $this->user = new UserM(); // создается экземпляр модели пользователя
            $this->cart = new CartM(); // создается экземпляр модели корзины
        }
        
        public function render(){           
            if (isset($_SESSION['user_id'])) {
                $user = $this->user -> account($_SESSION['user_id']);
            } else {
                $user['name'] = false;
            }

            $cartCount = $this->cart -> cartTotal($this->cart -> cart())[0];
            $cartSum = $this->cart -> cartTotal($this->cart -> cart())[1];
            $template = $this->twig -> loadTemplate('main.twig');
            echo $template -> render(array(
                'title' => $this->title,
                'content' => $this->content, 
                'user' => $user['name'], 
                'cartCount' => $cartCount,  
                'cartSum' => $cartSum,           
            ));
        }
    }
