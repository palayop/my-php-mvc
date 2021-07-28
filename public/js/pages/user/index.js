const fnUser = (function () {
    const dom = {
        frm: {
            $txtUser: $("#txtUser"),
            $txtPassword: $("#txtPassword")
        },
        $btnSave: $("#btnSave")
    }
    const events = {
        bind() {
            dom.$btnSave.on("click", events.save);
        },
        save() {
            $.ajax({
                type: 'post',
                url: '/DemoMVC/user/save',
                data: {
                    Username: dom.frm.$txtUser.val(),
                    Password: dom.frm.$txtPassword.val()
                },
                success: (result) => {
                    $("#dvResult").html(JSON.stringify(result))
                }
            })
        }
    }
    return {
        init() {
            events.bind();
        }
    }
})();
$(function () {
    fnUser.init();
})