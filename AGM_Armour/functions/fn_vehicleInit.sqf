/*
 * Author: KoffeinFlummi
 *
 * Well, it initializes things for vehicles you know...
 *
 * Arguments:
 * -> init EH
 *
 * Return Value:
 * none
 */

_vehicle = _this select 0;

if (_vehicle isKindOf "Air") exitWith {};

_vehicle addEventHandler ["HandleDamage", {_this call AGM_Armour_fnc_handleDamage}];