import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BranchDto } from 'src/app/shared/models/branch-dto';
import { environment } from 'src/environments/environment';
import { map } from 'rxjs/operators';
import { BranchRequestDto } from 'src/app/shared/models/branch-request-dto';
import { RegisterBranchDto } from '../../models/register-branch-dto';
import { EditBranchDto } from '../../models/edit-branch-dto';

@Injectable({
  providedIn: 'root',
})
export class BranchService {
  constructor(private httpClient: HttpClient) {}

  getBranches(branchRequestDto: BranchRequestDto) {
    return this.httpClient
      .post(environment.apiUrl + 'branch/get-branches', branchRequestDto)
      .pipe(
        map((response: BranchDto[]) => {
          return response;
        })
      );
  }

  getBranch(branchRequestDto: BranchRequestDto) {
    return this.httpClient
      .post(environment.apiUrl + 'branch/get-branch', branchRequestDto)
      .pipe(
        map((response: BranchDto) => {
          return response;
        })
      );
  }

  registerBranch(registerBranchDto: RegisterBranchDto) {
    return this.httpClient.post(
      environment.apiUrl + 'branch/register',
      registerBranchDto
    );
  }

  editBranch(editBranchDto: EditBranchDto) {
    return this.httpClient.post(
      environment.apiUrl + 'branch/edit-branch',
      editBranchDto
    );
  }
}
