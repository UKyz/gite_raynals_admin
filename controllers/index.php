<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 16/07/2018
 * Time: 11:54
 */

/*Reservations::deleteOldReservation();
Calendrier::dayPassed();*/

$smarty->assign('main_calendrier_script', Calendrier::mainCalendar());

$smarty->assign('price_calendrier_script', Calendrier::priceCalendar());

$smarty->assign('available_calendrier_script', Calendrier::availableCalendar());

$smarty->assign('demand_reservations_script', Reservations::demandReservations());

$smarty->assign('menu_accepted_reservations_script', Reservations::menuAcceptedReservations());

$smarty->assign('all_accepted_reservations_script', Reservations::acceptedReservations());

$smarty->assign('years_accepted_reservations_script', Reservations::acceptedReservationsByYear());

$smarty->assign('refused_reservations_script', Reservations::refusedReservations());

$smarty->assign('manage_reservations_script', Reservations::manageReservations());

$smarty->assign('services_script', Services::showServices());