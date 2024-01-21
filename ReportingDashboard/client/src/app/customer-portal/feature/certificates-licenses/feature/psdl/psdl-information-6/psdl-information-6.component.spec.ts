import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PsdlInformation6Component } from './psdl-information-6.component';

describe('PsdlInformation6Component', () => {
  let component: PsdlInformation6Component;
  let fixture: ComponentFixture<PsdlInformation6Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PsdlInformation6Component],
    }).compileComponents();

    fixture = TestBed.createComponent(PsdlInformation6Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
