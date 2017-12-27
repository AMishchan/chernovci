<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EasyWP
 */
?>

<?php
    setlocale(LC_TIME, 'ua_UA');
    $user = get_userdata( get_current_user_id() );
    $contract = itkr_get_contract($user->contract);
    $infos = itkr_get_accounting($user->contract);
?>

<?php get_header(); ?>
<style>
    td {padding: 5px;border: 1px solid silver;}
    table {width: 100%;}
</style>

<div class="container">
    <div class="row">

        <?php get_sidebar();?>

        <div class="col-sm-6">

            <table>
                <tr>
                    <td style=""><?= $user->display_name; ?></td>
                    <td style="text-align: center;"><a class="btn btn-sm btn-danger" href="<?php echo wp_logout_url( home_url() ); ?>" title="Выход">Вийти</a></td>
                </tr>
                <tr>
                    <td>Ваш особовий рахунок</td>
                    <td><?=$user->contract?></td>
                </tr>
                <tr>
                    <td>Адреса</td>
                    <td>вул. <?=$contract->street?> буд. <?=$contract->bud?> кв. <?=$contract->kwart?></td>
                </tr>
            </table>

            <div class="panel-group" id="accordion" style="margin-top: 10px;text-align: center">
                <?php foreach ($infos as $key => $info) : ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$key?>">
                                <?=strftime('%B %G', strtotime($info->date)); ?></a>
                        </h4>
                    </div>
                    <div id="collapse<?=$key?>" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table border="1" align="left" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="left"><b>Борг на початок місяця</b><br></td>
                                    <td align="left"><b><?=$info->saldop; ?></b><br></td>
                                </tr>
                                <tr>
                                    <td align="left"><b>Нараховано</b><br></td>
                                    <td align="left"><b><?=$info->narah; ?></b><br></td>
                                </tr>
                                <tr>
                                    <td align="left"><b>Перерахунки</b><br></td>
                                    <td align="left"><b><?=$info->pererah; ?></b><br></td>
                                </tr>
                                <tr>
                                    <td align="left"><b>Оплачено</b><br></td>
                                    <td align="left"><b><?=$info->oplata; ?></b><br></td>
                                </tr>
                                <tr>
                                    <td align="left"><b>Субсидія</b><br></td>
                                    <td align="left"><b><?=$info->subs; ?></b><br></td>
                                </tr>
                                <tr>
                                    <td align="left"><b>СУМА ДО ОПЛАТИ</b><br></td>
                                    <td align="left"><b><?= itkr_get_dooplat($info); ?></b><br></td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="2"><b>Довідково:</b><br></td>
                                </tr>
                                <tr>
                                    <td align="left"><b>Обовязкова частка для отримувачів субсидії</b><br></td>
                                    <td align="left"><b><?=$info->obs; ?></b><br></td>
                                </tr>
                                <tr>
                                    <td align="left"><b>Розстрочена сума </b><br></td>
                                    <td align="left"><b><?=$info->rozstr; ?></b><br></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>

        </div>

        <?php get_sidebar('right'); ?>

    </div>
</div>

<?php get_footer(); ?>






