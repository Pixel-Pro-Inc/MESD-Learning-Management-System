import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, timer } from 'rxjs';
import { switchMap, tap } from 'rxjs/operators';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class SessionManagementService {

  constructor(private httpClient: HttpClient) { }

  startTimer(intervalMiliseconds: number) {
    timer(intervalMiliseconds).subscribe(() => {
      this.refresh(); // Call the provided callback function when the timer elapses
    });
  }
  refresh() {
    let user = JSON.parse(localStorage.getItem('user'));
    let refreshDto = { refresh_token: user.refreshToken };
    this.httpClient
      .post(environment.apiUrl + 'account/refresh-token', refreshDto).subscribe((response) => {
        //Store user
        localStorage.setItem('user', JSON.stringify(response));
        let x: any = response;
        this.startTimer(x.expiryTime * 1000);
      });
  }
}
