import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map } from 'rxjs/operators';
import { environment } from 'src/environments/environment';
import { LoginDto } from '../../models/login-dto';
import { UserDto } from '../../models/user-dto';
import { Router } from '@angular/router';
@Injectable({
  providedIn: 'root',
})
export class AccountService {
  constructor(private httpClient: HttpClient, private routerService: Router) { }

  login(loginDto: LoginDto) {
    return this.httpClient
      .post(environment.apiUrl + 'account/login', loginDto);
  }

  otp(otpDto) {
    return this.httpClient
      .post(environment.apiUrl + 'account/otp', otpDto)
      .pipe(
        map((response: UserDto) => {
          return response;
        })
      );
  }

  sso(token) {
    return this.httpClient
      .get(environment.apiUrl + 'account/sso/' + token)
  }

  logout() {
    //Logout IAM
    localStorage.clear();

    this.routerService.navigateByUrl('/login');
  }
}
