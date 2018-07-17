<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 16/07/2018
 * Time: 11:54
 */

$smarty->assign('main_calendrier_script', Calendrier::mainCalendar());

$smarty->assign('price_calendrier_script', Calendrier::priceCalendar());

$smarty->assign('available_calendrier_script', Calendrier::availableCalendar());

$smarty->assign('demand_reservations_script', Reservations::demandReservations());

$smarty->assign('accepted_reservations_script', Reservations::acceptedReservations());

$smarty->assign('manage_reservations_script', Reservations::manageReservations());