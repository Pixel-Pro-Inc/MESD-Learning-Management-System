import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RegisterDiamondsComponent } from './register-diamonds.component';

describe('RegisterDiamondsComponent', () => {
  let component: RegisterDiamondsComponent;
  let fixture: ComponentFixture<RegisterDiamondsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ RegisterDiamondsComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(RegisterDiamondsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
