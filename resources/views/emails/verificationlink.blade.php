    <div style="width:100%!important;margin:0;padding:0;background-color:#ffffff">
        <table width="100%" cellspacing="0" cellpadding="0"
               style="margin:5px;padding:0;width:100%!important;border-collapse:collapse;background-color:#ffffff;color:#787878">
            <tbody>
            <tr style="padding:0">
                <td align="center" style="border-collapse:collapse;padding:0">
                    <table width="600" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                        <tbody>
                        <tr height="80" style="padding:0">
                            <td align="left" valign="bottom" style="border-collapse:collapse;padding:0">
                                <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                                    <tbody>
                                    <tr style="padding:0">
                                        <td rowspan="1" align="left" valign="bottom"
                                            style="border-collapse:collapse;padding:0"><a href="{{ url('') }}"
                                                                                          target="_blank"
                                                                                          ><img
                                                    src="{{ url('public/images/logo.png') }}"
                                                    alt="Delivery In hour" title="Delivery In hour" width="200" border="0"
                                                    style="outline:none;display:block;margin-bottom:10px;margin-top:25px"
                                                    class="CToWUd"></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table width="600" cellspacing="0" cellpadding="0"
                           style="border-collapse:collapse;border-bottom:1px solid #aaaaaa;margin-right:5px">
                        <tbody>
                        <tr style="padding:0">
                            <td style="border-collapse:collapse;padding:0">&nbsp;</td>
                        </tr>
                        </tbody>
                    </table>
                    <table width="600" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                        <tbody>
                        <tr style="padding:0">
                            <td height="40" style="border-collapse:collapse;padding:0">&nbsp;</td>
                        </tr>
                        </tbody>
                    </table>
                    <table width="600" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
                        <tbody>
                        <tr style="padding:0">
                            <td align="center" style="border-collapse:collapse;padding:0">
                                <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                                    <tbody>
                                    <tr style="padding:0">
                                        <td align="left" valign="middle" style="border-collapse:collapse;padding:0">
                                            <table width="100%" cellspacing="0" cellpadding="0"
                                                   style="border-collapse:collapse">
                                                <tbody>
                                                <tr style="padding:0">
                                                    <td align="left" style="border-collapse:collapse;padding:0">
                                                        <div>
                                                            <div
                                                                style="color:#353535;line-height:30px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:24px;font-weight:bold"></div>
                                                        </div>
                                                        <br>
                                                        <div>
                                                            <div
                                                                style="color:#787878;line-height:20px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px">
                                                                <p>Hello <a >{{ $details->fname ." " . $details->lname}}</a>,
                                                                </p>
                                                                <p><br></p>
                                                                <p>Thank you for signing up.</p>
                                                                <p>Please click on the button to complete the verification process.</p>
                                                                <table border="0" cellpadding="0" cellspacing="0"
                                                                       style="border-collapse:separate;width:100%;box-sizing:border-box;padding-top:20px">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td align="left"
                                                                            style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;vertical-align:top;padding-bottom:15px">
                                                                            <table border="0" cellpadding="0"
                                                                                   cellspacing="0"
                                                                                   style="border-collapse:separate;width:auto">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;vertical-align:top;background-color:#8cb36a;border-radius:5px;text-align:center">
                                                                                        <a href="{{ url('verified-email')."?id=".$details->id  ."&token=".strtotime($details->created_at).($details->car_make ?"&driver=true":"" ) }}"
                                                                                           style="display:inline-block;color:#ffffff;background-color:#8cb36a;border:solid 1px #8cb36a;border-radius:5px;box-sizing:border-box;text-decoration:none;font-size:14px;font-weight:bold;margin:0;padding:12px 25px;text-transform:capitalize;border-color:#8cb36a"
                                                                                           target="_blank">Verify</a></td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                                <p><br></p>

                                                                <p><br></p>
                                                                <p>Thanks,<br><b>DELIVER IN HOUR</b><br></p></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table width="600" cellspacing="0" cellpadding="0"
                           style="border-collapse:collapse;border-bottom:1px solid #aaaaaa;margin-right:5px">
                        <tbody>
                        <tr style="padding:0">
                            <td height="39" style="border-collapse:collapse;padding:0">&nbsp;</td>
                        </tr>
                        </tbody>
                    </table>
                    <table width="600" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
                        <tbody>
                        <tr style="padding:0">
                            <td valign="top" align="center" style="border-collapse:collapse;padding:0">
                                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
                                    <tbody>
                                    <tr style="padding:0">
                                        <td valign="top" align="left" style="border-collapse:collapse;padding:0">
                                            <table width="390" cellpadding="0" cellspacing="0" align="left"
                                                   style="border-collapse:collapse;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif">
                                                <tbody>
                                                <tr style="padding:0">
                                                    <td align="left" valign="top"
                                                        style="border-collapse:collapse;padding:0">
                                                        <div
                                                            style="color:#787878;line-height:15px;font-size:10px;text-transform:uppercase;word-spacing:-1px;margin-bottom:4px;margin-top:6px">
                                                            © {{ date('Y') }} Delivery In hour. All rights reserved.<br></div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style="padding:0">
                                        <td height="24" style="border-collapse:collapse;padding:0">&nbsp;</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="yj6qo"></div>
        <div class="adL"></div>
    </div>
