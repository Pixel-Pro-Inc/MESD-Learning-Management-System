import { Injectable } from '@angular/core';
import { CanActivate } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { UserDto } from '../../models/user-dto';
import { PreferencesService } from '../../services/preferences-service/preferences.service';

@Injectable({
  providedIn: 'root',
})
export class DeveloperGuard implements CanActivate {
  constructor(
    private preferencesService: PreferencesService,
    private toastService: ToastrService
  ) {}

  canActivate(): boolean {
    let user: UserDto = this.preferencesService.getPreferences().user;

    if (user) {
      return user.permissions.includes('Development');
    }

    this.toastService.error('You are unauthorized!');
  }
}
