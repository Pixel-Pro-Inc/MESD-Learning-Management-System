import { Injectable } from '@angular/core';
import {
  ActivatedRouteSnapshot,
  CanActivate,
  Router,
  RouterStateSnapshot,
  UrlTree,
} from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { Observable } from 'rxjs';
import { UserDto } from '../../models/user-dto';
import { PreferencesService } from '../../services/preferences-service/preferences.service';

@Injectable({
  providedIn: 'root',
})
export class AccountManagementGuard implements CanActivate {
  constructor(
    private preferencesService: PreferencesService,
    private toastService: ToastrService,
    private routerService: Router
  ) {}

  canActivate(): boolean {
    let user: UserDto = this.preferencesService.getPreferences().user;

    if (user) {
      if (!user.permissions.includes('Account Management')) {
        this.toastService.error('You are unauthorized!');
      }

      return user.permissions.includes('Account Management');
    }

    this.toastService.error('You are unauthorized!');
    return false;
  }
}
