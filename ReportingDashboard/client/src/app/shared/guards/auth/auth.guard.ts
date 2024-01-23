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
export class AuthGuard implements CanActivate {
  constructor(
    private preferencesService: PreferencesService,
    private toastService: ToastrService,
    private routerService: Router
  ) {}

  canActivate(): boolean {
    let user: UserDto = this.preferencesService.getPreferences().user;

    return true;

    if (user != null) {
      if (user.permissions.length == 1) {
        if (user.permissions[0] == 'External') {
          return true;
        }
      }
    }

    let prefs = this.preferencesService.getPreferences();
    prefs.nextPage = this.routerService.url;

    this.preferencesService.setPreferences(prefs);

    this.toastService.error('You are unauthorized!');
    this.routerService.navigateByUrl('/login');
  }
}
