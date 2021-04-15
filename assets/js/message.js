/**
 * Created by WebStorm.
 * @Author: 芒果
 * @Time: 2020/9/3 13:23
 * @Email: me.zhaoxuetao@qq.com
 */

;(function (window,$,ViewT){
    "use strict";


    if (!$){
        console.error('lack jQuery.js');
        return;
    }

    /**
     * 获取变量类型
     * @param value
     * @returns {string}
     */
    function getVarType(value){
        let type = Object.prototype.toString.call(value).toLocaleLowerCase();
        return type.replace(/[\[\]]/g,'').split(' ')[1];
    }

    const Message = {
        info: function (config) {

            let conf = this._getConf(config);
            conf.icon = '<i class="fa fa-exclamation-circle vt-icon vt-info" aria-hidden="true"></i>';
            conf.background = 'info';
            return this._make(conf);
        },
        error: function(config){

            let conf = this._getConf(config);
            conf.icon = '<i class="fa fa-times-circle vt-icon vt-error" aria-hidden="true"></i>';
            conf.background = 'error';
            return this._make(conf);
        },

        success: function(config){
            let conf = this._getConf(config);
            conf.icon = '<i class="fa fa-check-circle vt-icon vt-success" aria-hidden="true"></i>'
            conf.background = 'success';
            return this._make(conf);
        },

        warning: function (config) {

            let conf = this._getConf(config);
            conf.icon = '<i class="fa fa-exclamation-circle vt-icon vt-warning" aria-hidden="true"></i>';
            conf.background = 'warning';
            return this._make(conf);
        },

        /**
         * 面板
         * @param config
         * @returns {jQuery.fn.init|jQuery|HTMLElement}
         */
        panel: function(config){

            if (getVarType(config) != 'object'){
                config = {content: config};
            }
            config = Object.assign({},{
                closable: true,
                duration: 0,
                style: {
                    minWidth: 320
                }
            },config);
            return this._make(this._getConf(config));
        },
        /**
         * 获取配置
         * @param conf
         * @returns {Object}
         * @private
         */
        _getConf: function (conf) {
            let config = Object.assign({},this._config);
            if (conf && getVarType(conf) == 'object'){
                return Object.assign(config,conf)
            }else if(conf){
                return Object.assign(config, {
                    content: conf
                });
            }
            return config;
        },

        /**
         * 获取id
         * @returns {string}
         * @private
         */
        _getId: function(){
            return 'VtMessageId_' + Math.floor(Math.random() * 10000000);
        },

        /**
         * 配置
         */
        _config: {
            /**
             * 多少毫秒后关闭 <= 0 不关
             * @type {Number}
             */
            duration: 2500,
            /**
             * 背景色
             * @type {boolean|string}
             */
            background: false,
            /**
             * 前景色
             * @type {null|string}
             */
            color: null,
            /**
             * 提示内容
             * @type {string}
             */
            content: '',
            /**
             * 关闭时回调
             * @type {null|Function}
             */
            onclose: null,
            // 图标
            icon: '',
            /**
             * 自动关闭时 延迟多久后移除
             * @type {number}
             */
            animate_duration: 500,
            /**
             * 是否开启关闭按钮
             * @type {boolean}
             */
            closable: false,
            /**
             * 头部
             * @type {boolean|string} bool = false
             */
            header: false,
            /**
             * 标题 与 header 二者只能存其一 header 高于 title
             * @type {boolean|string} bool = false
             */
            title: false,

            /**
             * 底部
             * @type {boolean|string} bool = false
             */
            footer: false,

            /**
             * 底部确认按钮 用户点击回调
             * @type {boolean|Function} bool = false
             */
            confirm: function (cb){
                cb();
            },
            /**
             * 底部确认按钮文字
             * @type {string}
             */
            confirm_text: '确认',
            /**
             * 底部取消按钮 用户点击回调
             * @type {boolean|Function} bool = false
             */
            cancel: function (cb){
                cb();
            },
            /**
             * 底部取消按钮文字
             * @type {string}
             */
            cancel_text: '取消',
            /**
             *  宽度 高度
             *  @type {Array} ar[0] = 宽 ar[1] = 高
             */
            area: [],
            /**
             * 是否开启遮罩 谁开启遮罩谁能关闭
             * @type {boolean}
             */
            mask: false,
            /**
             * 父节点
             * 父节点不存在会默认创建一个
             * @type {jQuery|string|HTMLElement|null|boolean} string = selector
             */
            parent: null,
            /**
             * 是否移除父节点
             * @type {boolean}
             */
            remove_parent: false,
            /**
             * 位置
             * @type {string} css class
             * 目前有  vt-right-top、vt-left-top、vt-top-center、vt-left-center、
             * vt-center-center、vt-right-center、vt-left-bottom、vt-bottom-center、
             * vt-right-bottom
             * 其中 vt-right-top、vt-left-top、vt-top-center 默认没有使用 position: fixed
             * 如果需要使用 则加上 vt-fixed，如： vt-right-top vt-fixed
             * 每一个位置 css class 都有一个  同级 .vt-remove
             * 该参数最终会传递给 $.addClass()
             */
            offset: 'vt-right-top',
            /**
             * 样式
             * @type {null|Object}
             */
            style: null,
        },

        /**
         * 创建头部
         * @param $msg
         * @param conf
         * @private
         */
        _createHeader: function($msg,conf){
            if (conf.header){
                const $header = $(`<div class="vt-message-header">${conf.icon + conf.header}</div>`);
                $msg.prepend($header);
            }else if (conf.title){
                const $title = $(`<div class="vt-message-header"><div class="vt-header-text">${conf.icon + conf.title}</div></div>`)
                $msg.prepend($title);
            }
            this._createClose($msg,$msg.find('.vt-message-header'),conf);
        },


        /**
         * 创建 close 按钮
         * @param $msg
         * @param $header
         * @param conf
         * @private
         */
        _createClose: function($msg,$header,conf){
            if (conf.closable && $header.length){
                const $close = $(`<div class="vt-hide"><i class="fa fa-times" aria-hidden="true"></i></div>`);
                $header.append($close);
                $close.find('i').bind('click', () => {
                    this.hide($msg,conf);
                });
            }
        },

        /**
         * 创建内容
         * @param $msg
         * @param conf
         * @private
         */
        _createContent: function($msg,conf){

            let html = !conf.header && !conf.title && conf.icon ? conf.icon : '';
            html += conf.content;
            const $body = $(`<div class="vt-message-body">${html}</div>`);
            if (!conf.header && !conf.title && conf.closable){
                this._createClose($msg,$body,conf);
            }

            $msg.append($body);
        },


        /**
         * 创建底部
         * @param $msg
         * @param conf
         * @private
         */
        _createFooter: function($msg,conf){

            if (conf.footer && getVarType(conf.footer) == 'string'){
                $msg.append('<div class="vt-message-footer">${conf.footer}</div>');
            }else{
                if ((conf.cancel || conf.confirm) && conf.footer) {

                    const $footer = $ (`<div class="vt-message-footer"></div>`);
                    $msg.append ($footer);

                    if (conf.cancel) {
                        const $cancel = $ (`<button class="vt-cancel">${conf.cancel_text}</button>`);
                        $footer.append ($cancel);
                        $cancel.on ('click', () => {
                            let res = conf.cancel (() => {
                                this.hide ($msg, conf);
                            });
                            if (res === true) {
                                this.hide ($msg, conf);
                            }
                        });
                    }

                    if (conf.confirm) {
                        const $confirm = $ (`<button class="vt-confirm">${conf.confirm_text}</button>`);
                        $footer.append ($confirm);
                        $confirm.on ('click', () => {
                            let res = conf.confirm (() => {
                                this.hide ($msg, conf);
                            });
                            if (res === true) {
                                this.hide ($msg, conf);
                            }
                        });
                    }
                }
            }
        },

        /**
         * 设置遮罩
         * @param $msg
         * @param conf
         * @private
         */
        _setMask($msg,conf){
            if (conf.mask){
                let rand = Math.floor(Math.random() * 1000000);
                $msg.parent().addClass('vt-message-mask').data('mask',rand)
                $msg.data('mask',rand);
            }
        },

        /**
         * 隐藏
         * @param $msg
         * @param conf
         */
        hide: function ($msg,conf) {
            // 谁拉起的遮罩。那么就只允许它关闭
            if ($msg.data('mask') && $msg.parent().data('mask') && $msg.data('mask').toString() == $msg.parent().data('mask').toString()) {
                $msg.parent().removeClass('vt-message-mask').data('mask','0');
            }
            $msg.addClass('vt-remove');

            const cb = function () {
                if (conf.remove_parent) $msg.parent().remove();
                $msg.remove();
            };
            if(conf.onclose){
                conf.onclose(cb,$msg,conf);
            }else{
                setTimeout(cb,conf.animate_duration);
            }
        },


        /**
         * 制造一个
         * @param conf
         * @returns {jQuery.fn.init|jQuery|HTMLElement}
         * @private
         */
        _make: function (conf) {

            const msgId = this._getId();

            const $msg = $(`<div class="vt-message"  id="${msgId}"></div>`);

            this.getContainer(conf).append($msg);

            if (conf.class) $msg.addClass(conf.class);
            if (conf.color) $msg.css('color' ,conf.color);
            if (conf.background){
                if (/^(#|rgb\(|rgba\()/.test(conf.background)){
                    $msg.css('background-color',conf.background);
                }else{
                    $msg.addClass(`vt-background vt-bg-${conf.background}`)
                }
            }

            if (conf.style && getVarType(conf.style) == 'object'){
                $msg.css(conf.style);
            }
            this._createHeader($msg,conf);
            this._createContent($msg,conf);
            this._createFooter($msg,conf);

            if (conf.area.length > 0) $msg.css('width',conf.area[0]);
            if (conf.area.length > 1) $msg.css('height',conf.area[1]);

            this._setMask($msg,conf);
            if (conf.offset){
                if (getVarType(conf.offset) == 'string'){
                    $msg.addClass(conf.offset);
                }else{
                    $msg.css('position','absolute').css(conf.offset);
                }
            }

            if (conf.duration > 0){
                setTimeout( () => {
                    this.hide($msg,conf);
                },conf.duration);
            }
            return $msg;
        },

        /**
         * 获取容器元素
         * @param conf
         * @returns {jQuery}
         */
        getContainer(conf){

            let $container = conf.parent ? $(conf.parent) : $('.vt-message-package');

            if (!$container.length){
                $container = $('<div class="vt-message-package"></div>');
                $(document.body).append($container);
            }
            return $container;
        },
    };

    if (ViewT){
        ViewT.Message = Message;
    }
    window.VtMessage = Message;

})(window,window.jQuery,window.ViewT);