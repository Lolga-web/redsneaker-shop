<?php

/**
 * Контроллер показа страниц сайта
 */
    class PageC extends BaseC {

        /**
         * Главная страница сайта '/' или '/index.php'
         */
        public function index() {           
            $popularGoods = $this->page -> catalog('order_count', 'DESC', 20, true, true); //массив популярных товаров
            $newGoods = $this->page -> catalog('id', 'DESC', 12, true, true); //массив новых товаров

            $template = $this->twig -> loadTemplate('mainContent.twig');
            $this->content = $template -> render(array('popularGoods' => $popularGoods, 'newGoods' => $newGoods));
        }

        /**
         * Страница каталога '/catalog.php'
         */
        public function catalog() {
            $this->title .= ' | Каталог';
            
            $filters = $this->page -> filter(); //массив фильтров
            $goods = $this->page -> catalog('id', 'ASC', 24, $filters[0], $filters[1]); //массив товаров каталога

            $template = $this->twig -> loadTemplate('catalog.twig');
            $this->content = $template -> render(array('goods' => $goods));
        }

        /**
         * Страница описания товара '/good.php'
         */
        public function good() {
            $good = $this->page -> good(); //массив с описанием единицы товара

            $popularGoods = $this->page -> catalog('order_count', 'DESC', 20, true, true); //массив популярных товаров

            $this->title .= ' | Каталог | ' . $good['category'] . ' ' . $good['model'];

            $template = $this->twig -> loadTemplate('good.twig');
            $this->content = $template -> render(array('good' => $good, 'popularGoods' => $popularGoods));
        }

        /**
         * Страница отзывов '/feedbacks.php'
         */
        public function feedbacks() {
            $this->title .= ' | Отзывы';
            $template = $this->twig -> loadTemplate('feedbacks.twig');
            $feedbacks = $this->page -> feedbacks('опубликован');
            $this->content = $template -> render(array('feedbacks' => $feedbacks));
        }
        
        /**
         * Страница доставки '/delivery.php'
         */
        public function delivery() {
            $this->title .= ' | Доставка';
            $template = $this->twig -> loadTemplate('delivery.twig');
            $this->content = $template -> render(array());
        }

        /**
         * Страница оплаты '/payment.php'
         */
        public function payment() {
            $this->title .= ' | Оплата'; 
            $template = $this->twig -> loadTemplate('payment.twig');
            $this->content = $template -> render(array());
        }

        /**
         * Страница контактов '/contacts.php'
         */
        public function contacts() {
            $this->title .= ' | Контакты';
            $template = $this->twig -> loadTemplate('contacts.twig');
            $this->content = $template -> render(array());
        }

        /**
         * Страница возврата товара '/refund.php'
         */
        public function refund() {
            $this->title .= ' | Возврат товара';
            $template = $this->twig -> loadTemplate('refund.twig');
            $this->content = $template -> render(array());
        }

        /**
         * Страница рекомендаций '/recommend.php'
         */
        public function recommend() {
            $this->title .= ' | Рекомендации по уходу';
            $template = $this->twig -> loadTemplate('recommend.twig');
            $this->content = $template -> render(array());
        }

        /**
         * Страница гарантий '/warranty.php'
         */
        public function warranty() {
            $this->title .= ' | Гарантии';
            $template = $this->twig -> loadTemplate('warranty.twig');
            $this->content = $template -> render(array());
        }

        /**
         * Обработка формы подписки на рассылку
         */
        public function subscribe(){
            $res = $this->page -> subscribe();
        }
    }
