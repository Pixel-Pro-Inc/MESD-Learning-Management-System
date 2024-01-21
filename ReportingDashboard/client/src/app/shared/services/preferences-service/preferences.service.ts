import { Injectable } from '@angular/core';
import { Preferences } from '../../models/preferences';

@Injectable({
  providedIn: 'root',
})
export class PreferencesService {
  constructor() {}

  setPreferences(preferences: Preferences) {
    localStorage.setItem('prefs', JSON.stringify(preferences));
  }

  getPreferences() {
    let prefs: Preferences = JSON.parse(
      localStorage.getItem('prefs')
    ) as Preferences;

    if (prefs == null) {
      prefs = {} as Preferences;
    }

    return prefs;
  }
}
