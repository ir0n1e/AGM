/*
 * Author: KoffeinFlummi
 *
 * Handles vehicle damage and, if necessary, prevents explosions.
 *
 * Arguments:
 * -> HandleDamage EH
 *
 * Return Value:
 * None
 */

_vehicle = _this select 0;
_selectionName = _this select 1;
_damage = _this select 2;
_source = _this select 3;
_projectile = _this select 4;

_fatal = _selectionName in ["", "Hull?"]; // todo: check what values occur here
_explosive = [_vehicle] call AGM_Armour_fnc_explosivePotential;

if (_fatal and _damage >= 1) exitWith {
  if (_explosive > 0) then {
    1
  } else {
    0.89
  };
};