import { Injectable } from '@angular/core';
import {
  HttpInterceptor,
  HttpRequest,
  HttpHandler,
  HttpErrorResponse,
} from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { Router } from '@angular/router';
import { AccountService } from '../services/account-service/account.service';
import { PreferencesService } from '../services/preferences-service/preferences.service';

@Injectable()
export class AuthInterceptor implements HttpInterceptor {
  constructor(
    private accountService: AccountService,
    private router: Router,
    private preferencesService: PreferencesService
  ) {}

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<any> {
    return next.handle(request).pipe(
      catchError((error: HttpErrorResponse) => {
        if (error.status === 401) {
          this.accountService.logout();

          let prefs = this.preferencesService.getPreferences();
          prefs.nextPage = this.router.url;

          this.preferencesService.setPreferences(prefs);

          // Redirect to login page
          this.router.navigateByUrl('/sign-in');
        }
        return throwError(error);
      })
    );
  }
}
