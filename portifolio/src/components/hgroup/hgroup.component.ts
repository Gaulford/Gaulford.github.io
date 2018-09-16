import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class HgroupComponent extends Vue
{
    @Prop() private msg!: string;
}
