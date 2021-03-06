<?php /*a:2:{s:78:"/Users/guoyuzhao/sites/tuzisir-tool/application/admin/view/tool/edit_tool.html";i:1539312753;s:77:"/Users/guoyuzhao/sites/tuzisir-tool/application/admin/view/common/header.html";i:1539250433;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tuzisir Tool!</title>
    <meta name="keywords" content="tuzisir" />
    <meta name="description" content="tuzisir" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <script src="/tuzisir-tool/public/static/common/js/jquery.min.js" ></script>
    <script src="/tuzisir-tool/public/static/common/layui/layui.all.js"></script>
    <link href="/tuzisir-tool/public/static/common/layui/css/layui.css" rel="stylesheet">
    <link href="/tuzisir-tool/public/static/common/css/tuzisir.css" rel="stylesheet">
    <script src="/tuzisir-tool/public/static/common/js/my.layui.pack.js"></script>
</head>
<body>

<div style="padding: 1rem 0 0rem 1rem;">
    <span class="layui-breadcrumb" lay-separator="—">
        <a href="">Tool 管理</a>
        <a href="">修改 Tool</a>
    </span>
</div>
<hr class="layui-bg-orange">
<fieldset class="layui-elem-field width-35rem ml-3rem mt-2rem">
    <legend>修改 Tool</legend>
    <div class="layui-field-box">
        <form class="layui-form" action="">
            <!-- 隐藏域 -->
            <input type="hidden" lay-verify="required" value="<?php echo htmlentities($toolInfo['pic_url']); ?>" name="pic_url" id="tool-pic-url">
            <input type="hidden" lay-verify="required" value="<?php echo htmlentities($toolInfo['id']); ?>" name="id" id="tool-pic-url">
            <div class="layui-form-item">
                <label class="layui-form-label">上传图片</label>
                <div class="layui-upload">
                    <div class="layui-upload-list">
                        <img src="<?php echo htmlentities($toolInfo['pic_url']); ?>" class="layui-upload-img" id="upload-img" style="width: 10rem; height: 10rem;">
                        <p id="demoText"></p>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">Tool标题</label>
                <div class="layui-input-block">
                    <input type="text" value="<?php echo htmlentities($toolInfo['title']); ?>" name="title" lay-verify="required" autocomplete="off" placeholder="请输入标题" class="layui-input input-normal">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">Tool Url</label>
                <div class="layui-input-block">
                    <input type="text" name="url" value="<?php echo htmlentities($toolInfo['url']); ?>" lay-verify="required" autocomplete="off" placeholder="请输入Tool Url" class="layui-input input-long">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">Tool 简介</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入Tool简介" lay-verify="required" name="brief_introduction" class="layui-textarea input-long"><?php echo htmlentities($toolInfo['brief_introduction']); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="add-btn">立即</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</fieldset>

<script>
    layui.use(['form', 'layedit', 'laydate', 'element', 'upload'], function(){
        var form = layui.form
            ,layer = layui.layer
            ,layedit = layui.layedit
            ,element = layui.element
            ,upload  = layui.upload
        element.init();
        //普通图片上传
        var uploadInst = upload.render({
            elem: '#upload-img'
            ,url: "<?php echo url('/admin/tool/upload_img'); ?>"
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#upload-img').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                if(res.code === 200){
                    $("#tool-pic-url").val(res.data.file_url);
                }
            }
            ,error: function(){

            }
        });

        //监听提交
        form.on('submit(add-btn)', function(data){
            curlAjax("<?php echo url('admin/tool/edit_tool'); ?>", data.field, 'commonReturn');
            return false;
        });
    });

    // 公共ajax返回处理函数
    function commonReturn(data) {
        tipMsg(data.code, data.msg);
        if (data.code === 200) {
            window.location.href="<?php echo url('tool/index'); ?>";
        }
    }
</script>

