import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class SkillsComponent extends Vue
{
    @Prop() private msg!: string;
}
