<?php defined('InUk86') or exit('Access Invalid!'); ?>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <h3><?php echo $lang['nc_message_set']; ?></h3>
            <?php echo $output['top_link']; ?>
        </div>
    </div>
    <div class="fixed-empty"></div>
    <form method="post" id="form_email" name="settingForm">
        <input type="hidden" name="form_submit" value="ok"/>
        <table class="table tb-type2">
            <tbody>
            <tr class="noborder">
                <td colspan="2" class="required">选择短信平台:</td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform">
                    <?php if($output['list_setting']['sms_plugin']==0){ ?>
                      <label>
                        <input type="radio" name="sms_plugin" value="0" checked="checked" />亿美短信平台
                      </label>
                        <input type="radio" name="sms_plugin" value="1" />
                        普通短信平台
                      </label>
                     <?php }else{ ?>
                        <input type="radio" name="sms_plugin" value="0" />亿美短信平台
                      </label>
                        <input type="radio" name="sms_plugin" value="1" checked="checked" />
                        普通短信平台
                      </label>
                    <?php } ?>
                </td>
                <td class="vatop tips"><label class="field_notice">二选一</label></td>
            </tr>

            <tr class="noborder">
                <td colspan="2" class="required"><?php echo $lang['sms_url']; ?>:</td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="text" value="<?php echo $output['list_setting']['sms_url']; ?>"
                                                 name="sms_url" id="sms_url" class="txt"></td>
                <td class="vatop tips"><label class="field_notice"></label></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><?php echo $lang['sms_serial_number']; ?>:</td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="text"
                                                 value="<?php echo $output['list_setting']['sms_serial_number']; ?>"
                                                 name="sms_serial_number" id="sms_serial_number" class="txt"></td>
                <td class="vatop tips"><label class="field_notice"><?php echo $lang['sms_serial_number']; ?></label>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="required"><?php echo $lang['sms_password']; ?>:</td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="text"
                                                 value="<?php echo $output['list_setting']['sms_password']; ?>"
                                                 name="sms_password" id="sms_password" class="txt"></td>
                <td class="vatop tips"><label class="field_notice"><?php echo $lang['sms_password']; ?></label></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><?php echo $lang['sms_sessionKey']; ?>:</td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="text"
                                                 value="<?php echo $output['list_setting']['sms_sessionKey']; ?>"
                                                 name="sms_sessionKey" id="sms_sessionKey" class="txt"></td>
                <td class="vatop tips"><label class="field_notice">可选填写【使用亿美短信时用到】</label></td>
            </tr>

            <tr>
                <td colspan="2" class="required"><?php echo $lang['params_url']; ?>:</td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="text"
                                                 value="<?php echo $output['list_setting']['params_url']; ?>"
                                                 name="params_url" id="params_url" class="txt"></td>
                <td class="vatop tips"><label class="field_notice"><?php echo $lang['params_url']; ?></label></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><?php echo $lang['params_uid']; ?>:</td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="text"
                                                 value="<?php echo $output['list_setting']['params_uid']; ?>"
                                                 name="params_uid" id="params_uid" class="txt"></td>
                <td class="vatop tips"><label class="field_notice"><?php echo $lang['params_uid']; ?></label></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><?php echo $lang['params_auth']; ?>:</td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="text"
                                                 value="<?php echo $output['list_setting']['params_auth']; ?>"
                                                 name="params_auth" id="params_auth" class="txt"></td>
                <td class="vatop tips"><label class="field_notice"><?php echo $lang['params_auth']; ?></label></td>
            </tr>


            </tbody>
            <tfoot>
            <tr class="tfoot">
                <td colspan="2"><a href="JavaScript:void(0);" class="btn"
                                   onclick="document.settingForm.submit()"><span><?php echo $lang['nc_submit']; ?></span></a>
                </td>
            </tr>
            </tfoot>
        </table>
    </form>
</div>