import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map } from 'rxjs/operators';
import { environment } from 'src/environments/environment';
import { LoginDto } from '../../models/login-dto';
import { UserDto } from '../../models/user-dto';
import { PreferencesService } from '../preferences-service/preferences.service';
import { Preferences } from '../../models/preferences';
import { Router } from '@angular/router';
import { RegisterUserDto } from '../../models/register-user-dto';
import { PasswordResetDto } from '../../models/password-reset-dto';
import { EditUserDto } from '../../models/edit-user-dto';

@Injectable({
  providedIn: 'root',
})
export class AccountService {
  constructor(
    private httpClient: HttpClient,
    private preferencesService: PreferencesService,
    private routerService: Router
  ) {}

  login(loginDto: LoginDto) {
    return this.httpClient
      .post(environment.apiUrl + 'account/login', loginDto)
      .pipe(
        map((response: UserDto) => {
          return response;
        })
      );
  }

  registerUser(registerUserDto: RegisterUserDto) {
    return this.httpClient
      .post(environment.apiUrl + 'account/register', registerUserDto)
      .pipe(
        map((response: UserDto) => {
          return response;
        })
      );
  }

  logout() {
    let prefs: Preferences = this.preferencesService.getPreferences();

    prefs.user = null;
    prefs.nextPage = null;

    this.preferencesService.setPreferences(prefs);

    this.routerService.navigateByUrl('/sign-in');
  }

  getUsers() {
    return this.httpClient.get(environment.apiUrl + 'account/get-users').pipe(
      map((response: UserDto[]) => {
        return response;
      })
    );
  }

  editUser(editUserDto: EditUserDto) {
    return this.httpClient
      .post(environment.apiUrl + 'account/edit-user', editUserDto)
      .pipe(
        map((response: UserDto) => {
          return response;
        })
      );
  }

  /*Password Reset*/
  tokenRequest(accountID: string) {
    return this.httpClient.get(
      environment.apiUrl + 'account/token-request?accountID=' + accountID,
      {
        responseType: 'text',
      }
    );
  }

  passwordReset(passwordResetDto: PasswordResetDto) {
    return this.httpClient.post(
      environment.apiUrl + 'account/password-reset',
      passwordResetDto,
      {
        responseType: 'text',
      }
    );
  }
}
