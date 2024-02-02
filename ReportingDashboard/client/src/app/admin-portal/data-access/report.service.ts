import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map } from 'rxjs/operators';
import { CashierReportDto } from 'src/app/shared/models/cashier-report-dto';
import { DashboardDto } from 'src/app/shared/models/dashboard-dto';
import { DashboardRequestDto } from 'src/app/shared/models/dashboard-request-dto';
import { ReportRequestDto } from 'src/app/shared/models/report-request-dto';
import { SmsReport } from 'src/app/shared/models/sms-report';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class ReportService {
  constructor(private httpClient: HttpClient) { }

  getUsers() {
    return this.httpClient
      .get(environment.apiUrl + 'report/users');
  }


}
